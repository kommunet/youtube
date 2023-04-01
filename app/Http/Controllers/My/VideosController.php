<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Channel;
use App\Models\RecentTag;
use App\Models\Video;

use App\Helpers\YouTube;
use App\Http\Requests\UploadRequest;
use App\Jobs\ProcessVideo;

class VideosController extends Controller
{
	public function List(Request $request)
	{
		$user = $request->user();
		
		$videos = $user->videos()
					   ->orderBy("id", "desc")
					   ->paginate(10)
					   ->withQueryString();
		
		$tags = [];
		foreach($user->videos()->orderBy("created_at", "desc")->get() as $video)
			$tags = array_merge($tags, $video->tags());
		$tags = array_unique($tags);
		
		return view("my.videos.main", compact("user", "videos", "tags"));
	}
	
	public function Edit(Request $request)
	{
		// init video ID var
		$v_id = $request->video_id;
		
		// Get the video's information
		$video = Video::where("video_id", $v_id)
					  ->firstOrFail();
		
		// Store the uploader's information
		$uploader = $video->uploader();
		
		// let's check if the owner is viewing this page!
		if($uploader->id !== $request->user()->id)
			return redirect()->route("home");
		
		// Check if method is POST
		if($request->isMethod("post"))
		{
			
			// validate posts
			$request->validate([
				'title'       => 'required|string|max:100',
				'description' => 'string|max:10000',
				'tags'        => 'required|string|max:75',
				"channels"    => ["required", "array", "max:3"],
				"channels.*"  => ["required", "integer", "min:1", "max:21"],
			]);
			
			// weird hacky thing for numeric vals in array
			$channels = [];
			foreach($request->channels as $key => $channel)
				$channels[$key] = intval($channel);
			$request->channels = $channels;
			
			// Remove the video from each channel
			$dontTouch = [];
			foreach($video->channels() as $channel)
			{
				if(!in_array($channel->id, $request->channels))
				{
					// Update the channel's latest video
					$channel->update(["latest_video_added" => null]);
					
					// Increment number of videos added to that channel
					$channel->decrement("num_videos_today", 1);
					$channel->decrement("num_videos_total", 1);
				}
				else
					$dontTouch[] = $channel->id;
			}
			
			// Update the video
			$video->update([
				"title"       => $request->title,
				"description" => $request->description,
				"tags"        => $request->tags,
				"channels"    => $request->channels
			]);
			
			// Delete all previous tags
			RecentTag::where("video_id", $v_id)->delete();
			
			// Add the video to each channel
			foreach($request->channels as $channel)
			{
				if(!in_array($channel, $dontTouch))
				{
					// Grab the channel
					$channel = Channel::findOrFail($channel);
					
					// Update the channel's latest video
					$channel->update(["latest_video_added" => $v_id]);
					
					// Increment number of videos added to that channel
					$channel->increment("num_videos_today", 1);
					$channel->increment("num_videos_total", 1);
				}
			}
			
			// Add the tags into the DB for use in search and homepage
			foreach(explode(" ", $request->tags) as $tag)
			{
				RecentTag::create([
					"tag" => $tag, 
					"video_id" => $v_id,
					"uploader" => $uploader->username,
					"channels" => $request->channels
				]);
			}
			
			// Let's return a success message...
			return back()->with("success", "Video has been updated!");
		}
		
		// Grab all available channels
		$channels = Channel::all();
		
		// Return video edit page
		return view("my.videos.edit", compact("video", "channels"));
	}
	
	public function Remove(Request $request)
	{
		// init video ID var
		$v_id = $request->video_id;
		
		// Get the video's information
		$video = Video::where("video_id", $v_id)
					  ->first();
		
		// Store the uploader's information
		$uploader = $video->uploader();
		
		// let's check if the owner is viewing this page!
		if($uploader->id !== $request->user()->id)
			return redirect()->route("home");
		
		// Check if the method is POST
		if($request->isMethod("post"))
		{
			// Delete the video from the DB first of all
			$video->delete();
			
			// Delete the video from storage to save space
			Storage::disk("videos")->delete($v_id . ".flv");
			
			// Delete the thumbnails from storage to save space
			Storage::disk("thumbnails")->delete($v_id . "_1.jpg");
			Storage::disk("thumbnails")->delete($v_id . "_2.jpg");
			Storage::disk("thumbnails")->delete($v_id . "_3.jpg");
			
			// Decrement the number of videos the uploader has
			$uploader->decrement("num_public_videos", 1);
			
			// Update the uploader's latest video as to not cause problems
			$uploader->update([
				"latest_video" => Video::where("uploader", $uploader->username)
										
										// Make sure we get the latest
									   ->orderBy("created_at", "desc")
									   
									   // Get the first item to appear
									   ->first()
									   
									   // Get the video ID
									   ->video_id
			]);
			
			return redirect("/my_videos.php")->with("success", "\"".$video->title."\" has been removed from the site.");
		}
		
		// This view is used to let the user confirm before they delete the video
		return view("my.videos.remove", compact("video"));
	}
	
    public function Upload(Request $request)
	{
		return view("my_videos_upload", ["channels" => Channel::all()]);
	}
	
	public function UploadStep2(Request $request)
	{
		$request->validate([
			"title" => ["required", "string", "max:64"],
			"description" => ["max:500"],
			"tags" => ["required", "string", "max:255"],
			"channels" => ["required", "array", "max:3"],
			"channels.*" => ["required", "integer", "min:1", "max:21"],
		]);
		
		return view("my_videos_upload_2");
	}
	
	public function UploadComplete(Request $request)
	{
		$request->validate(["v" => "required"]);
		
		return view("my_videos_upload_complete", ["video_id" => $request->v]);
	}
	
	public function Process(UploadRequest $request)
	{
		// Generate a new video ID
		$id_loop = true;
		while($id_loop == true)
		{
			// Generate a new 11 char YouTube ID
			$v_id = YouTube::generateId();
			
			// If the video exists
			if(!Video::where('video_id', $v_id)->exists())
				$id_loop = false; // Cancel the loop
		}
		
		// For ease of access
		$file      = $request->file('file');
		$file_name = $file->getClientOriginalName();
		
		// Temporarily upload the video for the queue
		$file = Storage::disk('processing_videos')->putFile(null, $file);
		
		// Put the video in the queue along with its data
		ProcessVideo::dispatch((object) [
			"video_id"    => $v_id,
			"title"       => $request->title,
			"description" => $request->description,
			"tags"        => $request->tags,
			"uploader"    => $request->user()->username,
			"channels"    => json_encode($request->channels, JSON_NUMERIC_CHECK),
			"file"        => $file,
			"file_name"   => $file_name,
		]);
		
		// Redirect the user back
		return redirect(route("my_videos_upload_complete", ["v" => $v_id]));
	}
}
