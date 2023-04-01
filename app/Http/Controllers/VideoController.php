<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

use App\Helpers\YouTube;
use App\Models\SitesLinking;
use App\Models\Video;

class VideoController extends Controller
{
	public function view(Request $request)
	{
		// Get the video information
		$video = Video::where("video_id", $request->v);
					  
		// Redirect user to error if video does not exist
		if(!$video->exists())
			return redirect('/?unavail');
		
		// Let's make the video's info easy to access
		$video = $video->first();
		
		// Get the uploader's information
		$uploader = $video->uploader();
		
		// Get the related videos, paginated
		$related = $video->related()->paginate(4);
		
		// Let's see if the user is logged in and is subscribed
		$is_subscribed = (Auth::check()) ? $request->user()->subscribedTo($uploader->username) : false;
		
		// Get next video (was the first not playing video in the related box)
		$next = null;
		foreach($related as $item)
		{
			if($item->id !== $video->id)
			{
				$next = $item->video_id;
				break;
			}
		}
		
		// Get the related tags
		$tags = [];
		foreach($related as $item)
		{
			// Make sure we aren't including our own tags
			if($item->id !== $video->id)
			{
				// Add the other video tags to the array
				$tags = $tags + $item->tags();
			}
		}
		
		// Make sure there aren't duplicates
		$tags = collect(array_unique($tags));
		
		// Get video comments
		$comments = $video->comments();
		
		// Check if the user is authenticated, then request a view as well as finding the user's rating
		$user_rating = 0;
		if(Auth::check())
		{
			$request->user()->requestVideoView($request->v);
			
			$user_rating = $request->user()->getUserRating($request->v);
		}
		
		// Let's also check the referer
		$referer = $request->headers->get("referer");
		if($referer)
		{
			// Sanitize the URL before it goes into the DB
			$sanitized = YouTube::SanitizeUrl($referer);
			
			// If it's sanitized
			if($sanitized)
			{
				// Add it to the DB
				SitesLinking::firstOrCreate([
					"ip" => $request->ip(), 
					"referer" => $referer, 
					"video" => $request->v
				]);
			}
		}
		
		// Let's get the video's clicks
		$sites_linking = $video->sitesLinking();
		
		// And finally, let's get the video's attached channels
		$channels = $video->channels();
		
		// Return the watch page
		return view("watch", compact(
			"video", 
			"uploader", 
			"user_rating", 
			"next", 
			"related", 
			"is_subscribed", 
			"comments", 
			"tags", 
			"channels", 
			"sites_linking"
		));
	}
	
	public function embed(Request $request, string $video_id)
	{
		$video = Video::where("video_id", $video_id)->firstOrFail();
		
		$runtime = ceil($video->runtime);
		
		return redirect("/p.swf?video_id=$video_id&l=$runtime");
	}
}
