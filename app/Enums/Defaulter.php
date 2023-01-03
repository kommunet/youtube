<?php

namespace App\Enums;

trait Defaulter 
{
	public static function defaulter($id, $default)
	{
		try {
			return self::from($id);
		} catch (\ValueError $e) {
			return $default;
		}
	}
}