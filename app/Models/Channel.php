<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"latest_video_added",
		"num_videos_today",
		"num_videos_total",
		"num_groups_total"
	];
}
