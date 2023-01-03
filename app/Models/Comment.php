<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"comment_id",
		"body",
		"commenter",
		"video_id",
		"reference_video",
		"reply_parent_id",
	];
	
	public function commenter()
	{
		return User::where("username", $this->commenter)->first();
	}
	
	public function replies()
	{
		return Comment::where("reply_parent_id", $this->comment_id)->get();
	}
	
	public function referenceVideo()
	{
		return $this->belongsTo(Video::class, "video_id", "video_id");
	}
}
