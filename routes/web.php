<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// This group makes things look neat :)
Route::group(["prefix" => "/"], function() {
	
	// The homepage
	Route::get("", [HomepageController::class, "view"])->name("home");
	
	// Routes outside of the groups generally don"t need authentication
	Route::get("profile.php", [ProfileController::class, "view"])->name("profile");
	Route::get("profile_videos.php", [ProfileController::class, "videos"])->name("profile.videos");
	
	// Routes for users not yet authenticated
	Route::group(["middleware" => "guest"], function () {
		Route::any("login.php",  [AuthController::class, "doLogin"])->name("login");
		Route::any("signup.php", [AuthController::class, "doSignup"])->name("signup");
	});
	
	// Routing for watching videos
	Route::get("watch.php", [VideoController::class, "view"])->name("watch");
	
	// Routing for browsing videos
	Route::get("browse.php", [BrowseController::class, "videos"])->name("browse");
	
	// Routing for searching for videos
	Route::get("results.php", [BrowseController::class, "results"])->name("results");
	
	// Routing for searching for channels/soon to be categories
	Route::get("channels.php", [BrowseController::class, "channels"])->name("channels");
	
	// Routing for searching within a specific channel
	Route::get("channels_portal", [BrowseController::class, "channels_portal"])->name("channels_portal");
	
	// Routing for finding tags
	Route::get("tags.php", [BrowseController::class, "tags"])->name("tags");
	
	// Commenting servlet used on videos
	Route::any("comment_servlet", [API\WatchController::class, "commentServlet"])->name("comment_servlet");
	
	// Rating servlet used on videos
	Route::any("rating", [API\WatchController::class, "ratingServlet"])->name("rating_servlet");
	
	// Embed route
	Route::get("v/{video_id}", [VideoController::class, "embed"])->name("embed");
	
	// Video stream/thumbnail routes
	Route::get("get_video.php", [API\CdnController::class, "getVideo"])->name("get_video");
	Route::get("get_still.php", [API\CdnController::class, "getStill"])->name("get_still");
	
	// Contest stuff :)
	Route::get("monthly_contest.php", function () {
		
		// Return the current contest
		return view("contest.theki");
		
	})->name("monthly_contest");
	
	// Routes that need to be authenticated
	Route::group(["middleware" => "auth"], function() {
		
		// Temporary uploader routes
		Route::get("my_videos_upload.php", [My\VideosController::class, "upload"])->name("my_videos_upload");
		Route::post("my_videos_upload_2.php", [My\VideosController::class, "uploadStep2"])->name("my_videos_upload_2");
		Route::get("my_videos_upload_complete.php", [My\VideosController::class, "uploadComplete"])->name("my_videos_upload_complete");
		Route::post("my_videos_upload_post.php", [My\VideosController::class, "process"])->name("my_videos_upload_post");
		
		// Let the user log-out
		Route::any("logout.php", [AuthController::class, "doLogout"])->name("logout");
		
		// Profile settings
		Route::any("my_profile.php", [My\ProfileController::class, "process"])->name("my.profile");
		
		// List user videos
		Route::any("my_videos.php",        [My\VideosController::class, "list"])->name("my.videos");
		Route::any("my_videos_edit.php",   [My\VideosController::class, "edit"])->name("my.videos.edit");
		Route::any("my_videos_remove.php", [My\VideosController::class, "remove"])->name("my.videos.remove");
		
		// Subscriptions
		Route::any("subscription_center", [My\SubscriptionsController::class, "process"])->name("my.subscriptions");
		
		// Moderation actions for videos TO-DO MOVE THIS TO MODERATOR/ADMINISTRATOR ROUTE MIDDLEWARE
		Route::get("admin_feature.php", [Admin\VideoController::class, "feature"])->name("admin.feature");
		Route::get("admin_unfeature.php", [Admin\VideoController::class, "unfeature"])->name("admin.unfeature");
		Route::get("admin_remove.php", [Admin\VideoController::class, "remove"])->name("admin.remove");
		
		// Inbox routes
		Route::group(["as" => "inbox."], function () {
			Route::get("my_messages.php",      [My\MessagesController::class, "listReceived"])->name("received");
			Route::get("my_messages_sent.php", [My\MessagesController::class, "listSent"])->name("sent");
			Route::get("my_messages_view.php", [My\MessagesController::class, "viewMessage"])->name("view");
			Route::any("outbox.php",           [My\MessagesController::class, "composeMessage"])->name("compose");
		});
		
	});
	
});