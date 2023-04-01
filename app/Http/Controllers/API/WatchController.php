<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\YouTube;
use App\Models\Video;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Rating;

class WatchController extends Controller
{
    public function ratingServlet(Request $request)
	{
		switch(true)
		{
			case !Auth::check():
				return "Please log-in.";
			case $request->has("action_add_rating"):
				// Validate POST values
				$request->validate([
					"video_id" => ["required", "string", "exists:videos,video_id"],
					"rating"  => ["required", "numeric", "min:1", "max:5"],
				]);
				
				// Update/create the rating
				$rating = Rating::updateOrCreate(
					["video_id" => $request->video_id, "user_id"  => $request->user()->username],
					["rating"   => $request->rating]
				);
				
				// Initialize the video
				$video = Video::where("video_id", $request->video_id);
				
				// Update the video's rating count
				if($rating->wasRecentlyCreated && !$rating->wasChanged())
				{
					// Increment rating count
					$video ->increment("num_ratings", 1);
				}
				
				// Calculate the video's average rating
				$avg_rating = Rating::where("video_id", $request->video_id)
									->avg("rating");
				
				// Update the video with the average rating
				$video->update([
					"avg_rating" => $avg_rating,
				]);
				
				// Return the user back with a success message
				return "Thanks for the rating!";
			default:
				return "An error occurred.";
		}
	}
	
	public function commentServlet(Request $request)
	{
		switch(true)
		{
			case !Auth::check():
				return "LOGIN " . $request->form_id;
			case $request->has("add_comment"):
				// Validate POST values
				$request->validate([
					"video_id" => ["required", "string", "min:11", "max:11"],
					"comment"  => ["required", "string", "max:500"],
				]);
				
				// Get the video
				$video = Video::where("video_id", $request->video_id)->firstOrFail();
				
				// Get uploader and commenter
				$commenter = $request->user();
				$uploader  = $video->uploader();
				
				// Generate a new comment ID
				$id_loop = true;
				while($id_loop == true)
				{
					// Generate a new 11 char YouTube ID
					$c_id = YouTube::generateId();
					
					// If the video exists
					if(!Comment::where('comment_id', $c_id)->exists())
						$id_loop = false; // Cancel the loop
				}
				
				// Check if the reference video exists
				// TO-DO: Move this to its own rule
				$reference_video = Video::where("video_id", $request->field_reference_video);
				if(!$reference_video->exists() || $request->field_reference_video == $request->video_id)
					$request->field_reference_video = null;
				
				// Check if reply_parent_id exists
				// TO-DO: Also move this to its own rule somehow
				$comment = Comment::where("comment_id", $request->reply_parent_id)->first();
				$request->reply_parent_id = match (true) {
					// Does the comment exist?
					!$comment => null,
					
					// If the reply parent ID of the comment being responded to is filled
					// Set it to that same reply parent ID
					$comment->reply_parent_id !== null => $comment->reply_parent_id,
					
					// We already checked if the comment exists, let's just let it go thru
					default => $request->reply_parent_id,
				};
				
				// Create the comment
				Comment::create([
					"comment_id"      => $c_id,
					"body"            => $request->comment,
					"commenter"       => $commenter->username,
					"video_id"        => $request->video_id,
					"reference_video" => $request->field_reference_video,
					"reply_parent_id" => $request->reply_parent_id,
				]);
				
				// Update the video's comment count
				$video->increment("num_comments", 1);
				
				// Get the original comment from the reply_parent_id
				$og_comment = Comment::where("comment_id", $request->reply_parent_id)->first();
				
				// This will dictate whether we are sending it to the commenter or the replier
				$send_to = ($og_comment)
						    ? $og_comment->commenter()
						    : $uploader;
				
				// Send a message to the commenter or uploader
				if($send_to->id !== $commenter->id)
				{
					Message::create([
						"message_id" => YouTube::generateId(),
						"sent_by"    => $commenter->id,
						"sent_to"    => $send_to->id,
						"subject"    => $commenter->username . " has left a ".(($request->reply_parent_id) ? "reply to your comment on \"".$video->title."\"" : "comment on your video \"".$video->title."\""),
						"message"    => $commenter->username . " commented: \n\"" . $request->comment . "\"" . (($og_comment) ? "\n\nOriginal comment: \n\"".$og_comment->body."\"" : "")
					]);
				}
				
				// Return the user back with a success message
				return "OK " . $request->form_id;
			default:
				return "ERROR " . $request->form_id;
		}
	}
}
