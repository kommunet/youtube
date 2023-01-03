<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\CountryCodeRule;

use Carbon\Carbon;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function process(Request $request)
	{
		$user = $request->user();
		
		if($request->isMethod("post"))
		{
			$request->merge([
				"b_date" => $request->b_month."-".$request->b_day."-".$request->b_year
			]);
			
			$request->validate([
				"name" => ["nullable", "max:30"],
				"b_date" => ["string", "date_format:n-j-Y", "before:".Carbon::now()->addDays(1)->format("n-j-Y")], 
				"show_birthday" => ["in:0,1"],
				"gender" => ["nullable", "in:Male,Female"],
				"relationship_status" => ["nullable", "in:Single,Taken,Married"],
				"about_me" => ["nullable", "max:3000"],
				"personal_website" => ["nullable", "url", "max:50"],
				"country" => ["nullable", new CountryCodeRule()],
				"hometown" => ["nullable", "max:30"],
				"city" => ["nullable", "max:30"],
				"occupations" => ["nullable", "max:100"],
				"companies" => ["nullable", "max:100"],
				"schools" => ["nullable", "max:100"],
				"interests_hobbies" => ["nullable", "max:500"],
				"favorite_movies_shows" => ["nullable", "max:500"],
				"favorite_music" => ["nullable", "max:500"],
				"favorite_books" => ["nullable", "max:500"],
			]);
			
			// Init profile var
			$profile = new \stdClass;
			
			// Personal info
			$profile->name = $request->name;
			$profile->gender = $request->gender;
			$profile->relationship_status = $request->relationship_status;
			$profile->about_me = $request->about_me;
			$profile->personal_website = $request->personal_website;
			$profile->hometown = $request->hometown;
			$profile->city = $request->city;
			$profile->country = ($request->country) ? \Countries::getOne($request->country, "en") : null;
			$profile->occupations = $request->occupations;
			$profile->companies = $request->companies;
			$profile->schools = $request->schools;
			
			// Birthday and age
			$profile->birthday = new \stdClass;
			$profile->birthday->month = $request->b_month;
			$profile->birthday->day = $request->b_day;
			$profile->birthday->year = $request->b_year;
			$profile->age = ($request->show_birthday) ? Carbon::createFromFormat("n-j-Y", $request->b_date)->diffInYears(Carbon::now()) : null;
			
			// Interests
			$profile->interests_hobbies = $request->interests_hobbies;
			$profile->favorite_movies_shows = $request->favorite_movies_shows;
			$profile->favorite_music = $request->favorite_music;
			$profile->favorite_books = $request->favorite_books;
			
			// Save the data
			$user->profile = $profile;
			$user->save();
			
			// Redirect the user back
			return back()->with("success", "Updated your information.");
		}
		
		$profile = $user->profile;
		
		return view("my.profile", compact("profile"));
	}
}
