<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"message_id",
		"sent_by",
		"sent_to",
		"subject",
		"message",
		"is_read",
		"time_read"
	];
	
	public function sentBy()
	{
		return $this->belongsTo(User::class, "sent_by");
	}
	
	public function sentTo()
	{
		return $this->belongsTo(User::class, "sent_to");
	}
	
	public function canView($user)
	{
		return ($this->sent_by == $user->id || $this->sent_to == $user->id);
	}
}
