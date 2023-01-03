<?php

namespace App\Enums\Video;

enum View : string
{
	use \App\Enums\Defaulter;
	
	case Basic    = "b";
	case Detailed = "v";
	
	public function title() : string
	{
		return match($this)
		{
			self::Basic    => "Basic View",
			self::Detailed => "Detailed View",
		};
	}
}