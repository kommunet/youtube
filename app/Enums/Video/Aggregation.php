<?php

namespace App\Enums\Video;

use Carbon\Carbon;

enum Aggregation : string
{
	use \App\Enums\Defaulter;
	
	case Today     = "t";
	case ThisWeek  = "w";
	case ThisMonth = "m";
	case AllTime   = "a";
	
	public function title() : string
	{
		return match($this)
		{
			self::ThisWeek  => "This Week",
			self::ThisMonth => "This Month",
			self::AllTime   => "All Time",
			default         => $this->name,
		};
	}
	
	public function where() : array
	{
		return match($this)
		{
			self::Today     => [
				["created_at", ">=", Carbon::today()->subDays(1)]
			],
			self::ThisWeek  => [
				["created_at", ">=", Carbon::today()->subDays(7)]
			],
			self::ThisMonth => [
				["created_at", ">=", Carbon::today()->subDays(30)]
			],
			self::AllTime   => [],
		};
	}
}