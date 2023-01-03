<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comment;
use App\Models\User;

class Video extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"video_id",
		"title",
		"description",
		"uploader",
		"num_comments",
		"num_views",
		"num_ratings",
		"avg_rating",
		"last_featured",
		'last_viewed',
		"runtime",
		"tags",
		"misc",
	];
	
	protected $casts = [
		'misc' => 'object',
    ];
	
	protected $dates = [
		'last_featured',
		'last_viewed',
	];
	
	public function runtime()
	{
		return Carbon::parse($this->runtime)
					 ->format("i:s");
	}
	
	public function uploader()
	{
		return User::where("username", $this->uploader)->first();
	}
	
	public function comments()
	{
		return Comment::where("video_id", $this->video_id)
					  ->where("reply_parent_id", null)
					  ->get();
	}
	
	public function related()
	{
		$related = Video::where([]);
		foreach($this->tags() as $tag)
		{
			$related->orWhere("tags", "LIKE", "% $tag %")
					->orWhere("tags", "LIKE", "$tag %")
					->orWhere("tags", "LIKE", "% $tag")
					->orWhere("tags", "=", $tag);
		}
		
		return $related;
	}
	
	public function sitesLinking()
	{
		return SitesLinking::select("*", \DB::raw("count(*) as clicks"))
						   ->where("video", $this->video_id)
						   ->groupBy("referer")
						   ->limit(5)
						   ->get();
	}
	
	public function star($rating, $useSmall = false)
	{
		$prefix = $useSmall ? "/img/star_sm" : "/img/star";
		
		return match(true)
		{
			$this->avg_rating >= $rating         => "$prefix.gif",
			$this->avg_rating >= ($rating - 0.5) => "$prefix"."_half.gif",
			default                              => "$prefix"."_bg.gif"
		};
	}
	
	public function tags()
	{
		return explode(" ", $this->tags);
	}
	
	public function getLocation()
	{
		// For ease of access
		$misc = $this->misc;
		
		$location = match(true)
		{
			// Are both the address and country set?
			isset($misc->address_recorded) && isset($misc->country) => $misc->address_recorded.", ".$misc->country,
			
			// Is the address recorded set?
			isset($misc->address_recorded) => $misc->address_recorded,
			
			// Is the country set?
			isset($misc->country)          => $misc->country,
			
			// Or else, just default to false
			default => false,
		};
		
		// If we were unable to generate a location, return false
		if(!$location)
			return false;
		
		// Else
		return (object) [
			"text" => $location,
			"url"  => "http://maps.google.com/maps?t=h&q=".urlencode($location)
		];
	}
	
	public function isFeatured()
	{
		return $this->last_featured;
	}
	
	public function feature()
	{
		$this->last_featured = Carbon::now()->format("Y-m-d H:i:s");
		
		return $this->save();
	}
	
	public function unfeature()
	{
		$this->last_featured = null;
		
		return $this->save();
	}
}
