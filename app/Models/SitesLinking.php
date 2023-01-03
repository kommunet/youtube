<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitesLinking extends Model
{
    use HasFactory;
	
	protected $fillable = [
		"ip",
		"referer",
		"video"
	];
	
	protected $table = "sites_linking";
}
