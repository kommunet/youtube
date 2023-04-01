<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Enums\Video\Aggregation;
use App\Enums\Video\Sort;
use App\Enums\Video\View;

use App\Models\Channel;
use App\Models\RecentTag;
use App\Models\Video;
use App\Models\User;

class BrowseController extends Controller
{
	public $list = [
		"views" => [
			View::Basic,
			View::Detailed,
		],
		
		"aggregations" => [
			Aggregation::Today,
			Aggregation::ThisWeek,
			Aggregation::ThisMonth,
			Aggregation::AllTime,
		],
	];
	
    public function videos(Request $request)
	{
		// We're gonna look at the sorts first to determine how we order things
		$videos = Video::limit(300);
		
		// State which sort we are using, see App\Enums\Video\Sort
		$sort = Sort::defaulter($request->s, Sort::RecentlyFeatured);
		$order = $sort->order();
		
		// We order based on the filter, and we have a special parameter to add "rand" support
		($order[1] == "rand") ? $videos->inRandomOrder() : $videos->orderBy($order[0], $order[1]);
		
		// State which view we are using, see App\Enums\Video\View
		$view = View::defaulter($request->f, View::Basic);
		
		// State what aggregation we are using, see App\Enums\Video\Aggregation
		$aggregation = Aggregation::defaulter($request->t, Aggregation::AllTime);
		
		// We find videos based on the where clause for the filter
		$videos->where($aggregation->where());
		
		// Paginate the videos
		$videos = $videos->paginate(20)
			             ->withQueryString();
		
		// Return the view
		$list = $this->list;
		return view("browse", compact("videos", "sort", "view", "aggregation", "list"));
	}
	
	public function results(Request $request)
	{
		$validator = Validator::make($request->all(), [
			"search" => ["required", "min:3", "max:128"]
		]);
		
		if($validator->fails())
			return redirect('/')->with('error', $validator->errors()->first());
		
		$search = $request->search;
		
		$split_search = explode(" ", $search);
		
		$videos = Video::where([]);
		foreach($split_search as $tag)
		{
			$videos->orWhere("tags", "LIKE", "% $tag %")
				   ->orWhere("tags", "LIKE", "$tag %")
				   ->orWhere("tags", "LIKE", "% $tag")
				   ->orWhere("tags", "=", $tag);
		}
		$videos = $videos->paginate(20);
		
		$tags = [];
		foreach($videos as $video)
			$tags = $video->tags() + $tags;
		$tags = array_unique($tags);
		
		if(!$videos->count())
			return redirect('/')->with('error', 'No videos under "'.$search.'" could be found!');
		
		return view("results", compact("videos", "search", "tags"));
	}
	
	public function tags(Request $request)
	{
		$recent_tags = RecentTag::select("*", \DB::raw("count(*) as occurrences"))
						        ->groupBy("tag")
						        ->orderBy("created_at", "desc")
						        ->limit(100)
						        ->get();
		
		$popular_tags = RecentTag::select("*", \DB::raw("count(*) as occurrences"))
						         ->groupBy("tag")
						         ->orderBy("occurrences", "desc")
						         ->limit(100)
						         ->get();
		
		return view("tags", compact("recent_tags", "popular_tags"));
	}
	
	
	
	public function channels(Request $request)
	{
		if($request->c)
		{
			// Get the channel info
			$c = $request->c;
			$channel = Channel::findOrFail($c);
			
			// Get the videos attributed to this channel
			$videos = Video::orWhere("channels", "LIKE", "[$c,%")
						   ->orWhere("channels", "LIKE", "%,$c,%")
						   ->orWhere("channels", "LIKE", "%,$c]")
						   ->paginate(20);
			
			// Return the view
			return view("channels_videos", compact("videos", "channel"));
		}
		else
		{
			// i genuinely dont know what this does but it handles vertical grid all i can say
			// somehow i wrote this
			$order = [];
			for($i = 1; $i < 21; $i += 7) {
				if ($i + 7 > 21) {
					$order[] = $i;
					$i = $i - 13;
				}
				if ($i + 7 == 21) {
					$order[] = $i;
					$order[] = 21;
					break;
				}
				$order[] = $i;
			}
			
			// Return the view for channels...
			return view("channels", ["channels" => Channel::orderByRaw('FIELD(id, '.implode(',', $order).')')->get()]);
		}
	}
	
	public function channels_portal(Request $request)
	{
		// Get the channel info
		$c = $request->c;
		$channel = Channel::findOrFail($c);
		
		// Get the most active users in this channel
		$usersByName = RecentTag::orderBy("uploader")->pluck("uploader");
		$activeUsers = User::whereIn("username", $usersByName)->limit(5)->get();
		
		// Get the recently added videos to this channel
		$recentVideos = Video::orWhere("channels", "LIKE", "[$c,%")
							 ->orWhere("channels", "LIKE", "%,$c,%")
							 ->orWhere("channels", "LIKE", "%,$c]")
							 ->orderBy("created_at", "DESC")
							 ->paginate(20);
		
		// Get the top watched videos to this channel
		$topVideos = Video::orWhere("channels", "LIKE", "[$c,%")
						  ->orWhere("channels", "LIKE", "%,$c,%")
						  ->orWhere("channels", "LIKE", "%,$c]")
						  ->orderBy("num_views", "DESC")
						  ->paginate(20);
		
		// Get the recent tags to this channel
		$recentTags = RecentTag::orWhere("channels", "LIKE", "[$c,%")
							    ->orWhere("channels", "LIKE", "%,$c,%")
							    ->orWhere("channels", "LIKE", "%,$c]")
								->orderBy("created_at", "DESC")
								->limit(30)
								->get();
		
		// Return channels portal
		return view("channels_portal", compact("channel", "activeUsers", "recentVideos", "topVideos", "recentTags"));
	}
}
