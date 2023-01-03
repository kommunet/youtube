<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Video;

class VideoController extends Controller
{
    public function Feature(Request $request)
	{
		if($request->user()->isModerator())
		{
			// Get the video's info for ease of access
			$video = Video::where("video_id", $request->video_id)->firstOrFail();
			
			// Feature the video
			$video->feature();
			
			// Let the moderator know that the video has been featured
			return back()->with("success", "Successfully featured this video.");
		}
	}
	
	public function Unfeature(Request $request)
	{
		if($request->user()->isModerator())
		{
			// Get the video's info for ease of access
			$video = Video::where("video_id", $request->video_id)->firstOrFail();
			
			// Unfeature the video
			$video->unfeature();
			
			// Let the moderator know that the video has been unfeatured
			return back()->with("success", "Successfully unfeatured this video.");
		}
	}
	
	public function Remove(Request $request)
	{
		if($request->user()->isModerator())
		{
			// Get the video's info for ease of access
			$video = Video::where("video_id", $request->video_id)->firstOrFail();
			
			// Get the uploader's info for ease of access
			$uploader = $video->uploader();
			
			// Delete the video from the DB first of all
			$video->delete();
			
			// Delete the video from storage to save space
			Storage::disk("videos")->delete($request->video_id . ".flv");
			
			// Delete the thumbnails from storage to save space
			Storage::disk("thumbnails")->delete($request->video_id . "_1.jpg");
			Storage::disk("thumbnails")->delete($request->video_id . "_2.jpg");
			Storage::disk("thumbnails")->delete($request->video_id . "_3.jpg");
			
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
			
			return redirect("/")->with("success", "\"".$video->title."\" has been removed from the site.");
		}
	}
}
