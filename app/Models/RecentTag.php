<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentTag extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"tag",
		"video_id",
		"uploader",
		"channels"
	];
	
	protected $casts = [
		'channels' => 'array',
    ];
}
