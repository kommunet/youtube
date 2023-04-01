<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Subscription;
use App\Models\User;

class SubscriptionsController extends Controller
{
    public function process(Request $request)
	{
		// Add user action
		switch(true)
		{
			case $request->add_user:
				if($request->add_user !== $request->user()->username)
				{
					// We'll check if the subscription already exists
					$subscription = Subscription::where([
						["user_id", "=", $request->user()->username], 
						["subscribed_to", "=", $request->add_user]
					]);
					
					// Get the channel for ease of access
					$channel = User::where("username", $request->add_user)->first();
					
					// Check if the subscription doesn't already exist
					if(!$subscription->exists() && $channel->exists())
					{
						// Create the subscription
						Subscription::create([
							"user_id" => $request->user()->username,
							"subscribed_to" => $channel->username
						]);
						
						// Update the channel
						$num_subscribers = Subscription::where("subscribed_to", $request->add_user)->count();
						$channel->num_subscribers = $num_subscribers;
						$channel->save();
						
						// Let the user know that the subscription had been made
						$request->session()->now("success", "You have subscribed to ".$channel->username."!");
					}
				}
				else
				{
					// Let the user know that you cannot subscribe to yourself
					$request->session()->now("error", "You cannot subscribe to yourself!");
				}
				break;
			case $request->remove_user:
				// Get the channel for ease of access
				$channel = User::where("username", $request->remove_user)->first();
				
				// Check if the user exists
				if($channel->exists())
				{
					// Remove the subscription
					Subscription::where("user_id", $request->user()->username)
								->where("subscribed_to", $channel->username)
								->delete();
					
					// Update the channel
					$num_subscribers = Subscription::where("subscribed_to", $request->add_user)->count();
					$channel->num_subscribers = $num_subscribers;
					$channel->save();
					
					// Let the user know that we have unsubscribed
					$request->session()->now("error", "You have unsubscribed from ".$channel->username."!");
				}
		}
		
		$subscriptions = $request->user()->subscriptions()->paginate(15);
		
		return view("my.subscriptions", compact("subscriptions"));
	}
}
