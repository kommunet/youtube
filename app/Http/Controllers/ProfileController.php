<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileController extends Controller
{
    public function view(Request $request)
	{
		$user = User::where('username', $request->user)->firstOrFail();
		
		return view("profile", compact("user"));
	}
}
