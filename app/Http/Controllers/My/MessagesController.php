<?php

namespace App\Http\Controllers\My;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;

use Carbon\Carbon;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
	public function listSent(Request $request)
	{
		$messages = Message::where("sent_by", $request->user()->id)->get();
		
		return view("inbox.view_inbox", ["tab" => "sent", "messages" => $messages]);
	}
	
	public function listReceived(Request $request)
	{
		$messages = Message::where("sent_to", $request->user()->id)->get();
		
		return view("inbox.view_inbox", ["tab" => "inbox", "messages" => $messages]);
	}
	
    public function viewMessage(Request $request)
	{
		$message = Message::findOrFail($request->mid);
		
		if(!$message->canView($request->user()))
			return redirect()->route("home");
		
		$from = $message->sentBy;
		$to = $message->sentTo;
		$tab = ($from->id == $request->user()->id) ? 'sent' : 'inbox';
		
		if($tab == 'inbox')
		{
			$message->is_read   = true;
			$message->time_read = Carbon::now();
		}
		
		$message->save();
		
		return view("inbox.view_message", compact("message", "from", "to", "tab"));
	}
	
	public function composeMessage(Request $request)
	{
		$from = $request->user();
		$to = User::where('username', $request->user)->firstOrFail();
		
		if($request->subject && $request->message)
		{
			$request->validate([
				"subject" => ["string", "min:3", "max:60"],
				"message" => ["string", "min:3", "max:5000"]
			]);
			
			Message::create([
				"sent_by" => $from->id,
				"sent_to" => $to->id,
				"subject" => $request->subject,
				"message" => $request->message
			]);
			
			return redirect()->route("profile", ["user" => $to->username])
							 ->with("success", "Sent ".$to->username." your message!");
		}
		elseif($request->subject || $request->message)
			return back()->withErrors("Your message is missing a subject/body.");
		
		return view("inbox.compose_message", compact("from", "to"));
	}
}
