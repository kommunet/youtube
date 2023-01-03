<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Subscription extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"user_id",
		"subscribed_to"
	];
	
	public function user()
	{
		return $this->belongsTo(User::class, "subscribed_to", "username");
	}
}
