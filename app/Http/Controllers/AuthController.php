<?php

namespace App\Http\Controllers;

use App\Models\User;

use Carbon\Carbon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function doLogin(Request $request)
	{
		if($request->isMethod('post'))
		{
			$request->validate([
				"username" => ["required", "string", "alpha_num"],
				"password" => ["required", "string"],
			]);
			
			$creds = $request->only("username", "password");
			
			if(Auth::attempt($creds))
			{
				$user = Auth::user();
				
				$now = Carbon::now()->format("Y-m-d H:i:s");
				$user->last_login = $now;
				$user->last_online = $now;
				
				$user->last_login_ip = $request->ip();
				
				$user->save();
				
				return redirect()->route("home");
			}
			
			return back()->withErrors(["err" => "Incorrect username or password."])
						 ->withInput();
		}
		
		return view("login");
	}
	
	public function doSignup(Request $request)
	{
		if($request->isMethod('post'))
		{
			$request->validate([
				"email" => ["required", "email", "unique:users"],
				"username" => ["required", "unique:users", "min:3", "max:20", "alpha_num"],
				"password" => ["required", "min:1", "max:20", "confirmed"],
			]);
			
			$user = User::create([
				"username"      => $request->username,
				"password"      => Hash::make($request->password),
				"email"         => $request->email,
				"last_login"    => Carbon::now()->format("Y-m-d H:i:s"),
				"register_ip"   => $request->ip(),
				"last_login_ip" => $request->ip(),
			]);
			
			Auth::login($user);
			
			return redirect()->route("home");
		}
		
		return view("signup");
	}
	
	public function doLogout(Request $request)
	{
		Session::flush();
		
		Auth::logout();
		
		return redirect()->route("home");
	}
}
