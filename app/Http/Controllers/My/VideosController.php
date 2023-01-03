<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Video;

use App\Helpers\YouTube;
use App\Http\Requests\UploadRequest;
use App\Jobs\ProcessVideo;

class VideosController extends Controller
{
	public function List(Request $request)
	{
		// this will eventually be the my_videos.php page
	}
	
    public function Upload(Request $request)
	{
		return view("uploader");
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
		$file = $request->file('video');
		
		// Temporarily upload the video for the queue
		$file = Storage::disk('processing_videos')->putFile(null, $file);
		
		// Put the video in the queue along with its data
		ProcessVideo::dispatch((object) [
			"video_id"    => $v_id,
			"title"       => $request->title,
			"description" => $request->description,
			"tags"        => $request->tags,
			"uploader"    => $request->user()->username,
			"file"        => $file,
		]);
		
		// Redirect the user back
		return back()->with("success", "Your video has uploaded! It may not be immediately available.");
	}
}
