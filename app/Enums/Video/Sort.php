<?php

namespace App\Enums\Video;

enum Sort : string
{
	use \App\Enums\Defaulter;
	
	case MostRecent       = "mr";
	case MostViewed       = "mv";
	case MostDiscussed    = "md";
	case MostFavorited    = "mf";
	case TopRated         = "tr";
	case RecentlyFeatured = "rf";
	case Random           = "r";
	
	public function title() : string
	{
		return match($this)
		{
			self::MostRecent       => "Most Recent",
			self::MostViewed       => "Most Viewed",
			self::MostDiscussed    => "Most Discussed",
			self::MostFavorited    => "Top Favorited",
			self::TopRated         => "Top Rated",
			self::RecentlyFeatured => "Recently Featured",
			self::Random           => "Random",
		};
	}
	
	public function order() : array
	{
		return match($this)
		{
			self::MostRecent       => ["created_at", "desc"],
			self::MostViewed       => ["num_views", "desc"],
			self::MostDiscussed    => ["num_comments", "desc"],
			self::MostFavorited    => ["num_favorites", "desc"],
			self::TopRated         => ["avg_rating", "desc"],
			self::RecentlyFeatured => ["last_featured", "desc"],
			self::Random           => ["created_at", "rand"],
		};
	}
	
	public function hasAggregation() : bool
	{
		return ($this == self::MostViewed);
	}
}