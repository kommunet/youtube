<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Carbon\Carbon;

use App\Models\Message;
use App\Models\ProfileView;

use App\Models\Rating;
use App\Models\Video;
use App\Models\VideoView;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
		'email',
		'profile',
		'num_public_videos',
		'num_private_videos',
		'num_favorites',
		'num_friends',
		'num_subscribers',
		'num_playlists',
		'num_profile_views',
		'num_videos_watched',
		'latest_video',
		'last_online',
		'last_login',
		'register_ip',
		'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
		'profile' => 'object',
    ];
	
	/**
	 * Lets us cast certain columns as timestamps
	 */
	protected $dates = [
		"created_at",
		"updated_at",
		"last_login",
		"last_online",
	];
	
	public function online()
	{
		return \Carbon\Carbon::parse($this->last_online)->addMinutes(10)->gt(\Carbon\Carbon::now());
	}
	
	public function isModerator()
	{
		return $this->is_moderator;
	}
	
	public function isAdministrator()
	{
		return $this->is_administrator;
	}
	
	public function messages()
	{
		return Message::where("sent_to", $this->id)
					  ->orderBy("id", "desc")
					  ->get();
	}
	
	public function unreadMessages()
	{
		return Message::where("sent_to", $this->id)
					  ->where("is_read", false)
					  ->orderBy("id", "desc")
					  ->get();
	}
	
	public function sentMessages()
	{
		return Message::where("sent_by", $this->id)
					  ->orderBy("id", "desc")
					  ->get();
	}
	
	public function videos()
	{
		return Video::where("uploader", $this->username);
	}
	
	public function subscriptions()
	{
		return Subscription::where("user_id", $this->username)
						   ->orderBy("id", "desc");
	}
	
	public function subscribedTo($userId)
	{
		return Subscription::where("user_id", $this->username)
						   ->where("subscribed_to", $userId)
						   ->exists();
	}
	
	public function hasModifiedProfile()
	{
		// any way to make this cleaner?
		return (json_encode($this->profile) !== json_encode([
			"name" => null,
			"birthday" => [
				"month" => null, 
				"day" => null,
				"year" => null,
			],
			"age" => null,
			"gender" => null,
			"relationship_status" => null,
			"about_me" => null,
			"personal_website" => null,
			"hometown" => null,
			"city" => null,
			"country" => null,
			"occupations" => null,
			"companies" => null,
			"schools" => null,
			"interests_hobbies" => null,
			"favorite_movies_shows" => null,
			"favorite_music" => null,
			"favorite_books" => null,
		]));
	}
	
	public function getUserRating($videoId)
	{
		// We want to find out if the user rated the video
		$rating = Rating::where("video_id", $videoId)
					    ->where("user_id", $this->username)
					    ->first();
		
		// If the rating does not exist
		if(!$rating)
			return 0; // Return 0 for the rating
		
		return $rating->rating;
	}
	
	public function requestVideoView($videoId)
	{
		// Let's get the video for ease of access
		$video = Video::where("video_id", $videoId)->firstOrFail();
		
		// Let's get the uploader for ease of access
		$uploader = $video->uploader();
		
		// We won't need to add another view again...
		$view = VideoView::firstOrCreate(["viewer" => $this->username, "video" => $videoId]);
		
		// Check if the view was recently created
		if($view->wasRecentlyCreated && !$view->wasChanged())
		{
			// Increment view count
			$video->increment("num_views", 1);
			
			// Let's increment the number of video views the uploader has...
			$uploader->increment("num_video_views", 1);
			
			// Let's update the amount of videos that the user has watched
			$this->increment("num_videos_watched", 1);
		}
		
		// Let's update the last_viewed timestamp for the video as well
		$video->last_viewed = Carbon::now()->format("Y-m-d H:i:s");
		
		// Save the video!
		$video->save();
	}
	
	public function requestProfileView($username)
	{
		// Let's get the user for ease of access
		$user = User::where("username", $username)->firstOrFail();
		
		// We won't need to add another view again...
		$view = ProfileView::firstOrCreate(["viewer" => $this->username, "user" => $username]);
		
		// Check if the view was recently created
		if($view->wasRecentlyCreated && !$view->wasChanged())
		{
			// Increment view count
			$this->increment("num_profile_views", 1);
		}
		
		// Let's update the last_viewed timestamp for the user as well
		$user->last_viewed = Carbon::now()->format("Y-m-d H:i:s");
		
		// And save!
		$user->save();
	}
}
