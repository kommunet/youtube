<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Video;

class ProfileController extends Controller
{
    public function view(Request $request)
	{
		$user = User::where('username', $request->user)->firstOrFail();
		
		$video = Video::where('uploader', $request->user)
					  ->orderBy("id", "desc")
					  ->first();
		
		if(Auth::check()) $request->user()->requestProfileView($request->user);
		
		$is_subscribed = (Auth::check()) ? $request->user()->subscribedTo($request->user) : false;
		
		return view("profile", compact("user", "video", "is_subscribed"));
	}
	
	public function videos(Request $request)
	{
		$user = User::where('username', $request->user)->firstOrFail();
		
		$videos = $user->videos()
					   ->orderBy("id", "desc")
					   ->paginate(10)
					   ->withQueryString();
		
		$tags = [];
		foreach($user->videos()->orderBy("created_at", "desc")->get() as $video)
			$tags = array_merge($tags, $video->tags());
		$tags = array_unique($tags);
		
		return view("profile_videos", compact("user", "videos", "tags"));
	}
}
