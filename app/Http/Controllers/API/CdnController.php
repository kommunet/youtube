<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CdnController extends Controller
{
    public function getVideo(Request $request)
	{
		// Specify our disks for easy access
		$public = Storage::disk("public");
		$video  = Storage::disk("videos");
		
		// Specify our variables for easy access
		$video_id = $request->video_id;
		
		// Specify our path
		$path = $video_id.'.flv';
		
		// If the video ID is not specified or the thumbnail simply doesn't exist
		if(!$video_id || !$video->exists($path))
			return "Not found.";
		
		// Return the video if found
		$response = $video->response($path);
		$response->headers->set("Cache-Control", "max-age=31536000");
		return $response;
	}
	
    public function getStill(Request $request)
	{
		// Specify our disks for easy access
		$public = Storage::disk("public");
		$thumb  = Storage::disk("thumbnails");
		
		// Specify our variables for easy access
		$video_id = $request->video_id;
		$still_id = ($request->still_id > 0) ? $request->still_id : 1;
		
		// Specify our path
		$path = $video_id."_".$still_id.'.jpg';
		
		// If the video ID is not specified or the thumbnail simply doesn't exist
		if(!$video_id || !$thumb->exists($path))
			return $public->response("img/unavailable.jpg"); // Return our default image
		
		// Return the thumbnail if found
		$response = $thumb->response($path);
		$response->headers->set("Cache-Control", "max-age=31536000");
		return $response;
	}
}
