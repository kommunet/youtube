<?php

namespace App\Helpers;

class YouTube
{
	private static $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-";
	
	private static $id_length = 11;
	
	public static function GenerateId() : string
	{
		return substr(
			str_shuffle(self::$charset),
			0, self::$id_length,
		);
	}
	
	//https://stackoverflow.com/a/35207936
	public static function BuildUrl(array $parts) : string
	{
		return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') . 
			   ((isset($parts['user']) || isset($parts['host'])) ? '//' : '') . 
			   (isset($parts['user']) ? "{$parts['user']}" : '') . 
			   (isset($parts['pass']) ? ":{$parts['pass']}" : '') . 
			   (isset($parts['user']) ? '@' : '') . 
			   (isset($parts['host']) ? "{$parts['host']}" : '') . 
			   (isset($parts['port']) ? ":{$parts['port']}" : '') . 
			   (isset($parts['path']) ? "{$parts['path']}" : '') . 
			   (isset($parts['query']) ? "?{$parts['query']}" : '') . 
			   (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
	}
	
	public static function SanitizeUrl(string $url)
	{
		$url = parse_url($url);
		
		if(!isset($url["scheme"]))
			return false;
		
		if(substr($url["scheme"], 0, 4) !== "http")
			return false;
		
		if(str_contains($url["host"], env("YOUTUBE_URL")))
			return false;
		
		$check_against = ["host", "path", "query"];
		foreach($check_against as $part)
		{
			try {
				$len = strlen($url[$part]);
				if($len > 100)
				{
					if($part == "host")
						return false;
					
					$url[$part] = null;
				}
			} 
			catch (\Exception $e)
			{
				$url[$part] = null;
			}
		}
		
		return self::BuildUrl($url);
	}
	
	public static function format($datetime, $format)
	{
		$datetime->subYears(17);
		
		return $datetime->format($format);
	}
}
