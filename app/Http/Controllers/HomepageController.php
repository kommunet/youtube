<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\RecentTag;
use App\Models\Video;

class HomepageController extends Controller
{
    public function View(Request $request)
	{
		if($request->has('unavail'))
			$request->session()->now('error', 'The video you have requested is not available.
		
			If you have recently uploaded this video, you may need to wait a few minutes for the video to process.');
		
		$recently_viewed = Video::where("last_viewed", "!=", "")
								->orderBy("last_viewed", "desc")
								->limit(12)
								->get();
		
		if(Auth::check())
			$subscriptions = $request->user()->subscriptions()->pluck("subscribed_to");
		
		$my_video_subscriptions = (Auth::check()) ? Video::whereIn("uploader", $subscriptions)
														 ->orderBy("created_at", "desc")
												         ->limit(12)
												         ->get()
										          : null;
		
		$featured_videos = Video::where("last_featured", "!=", "")
								->orderBy("last_featured", "desc")
								->limit(10)
								->get();
		
		$tags = RecentTag::select("*", \DB::raw("count(*) as occurrences"))
				         ->groupBy("tag")
				         ->orderBy("id", "desc")
				         ->limit(50)
				         ->get();
	
		return view("home", compact("recently_viewed", "my_video_subscriptions", "featured_videos", "tags"));
	}
}
