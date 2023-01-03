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

// The homepage
Route::get("/", [HomepageController::class, "view"])->name("home");

// This group makes things look neat :)
Route::group(["prefix" => "/"], function() {
	
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
	
	// Routing for finding tags
	Route::get("tags.php", [BrowseController::class, "tags"])->name("tags");
	
	// Commenting servlet used on videos
	Route::any("comment_servlet", [API\WatchController::class, "commentServlet"])->name("comment_servlet");
	
	// Rating servlet used on videos
	Route::any("rating", [API\WatchController::class, "ratingServlet"])->name("rating_servlet");
	
	// Video stream/thumbnail routes
	Route::get("get_video.php", [API\CdnController::class, "getVideo"])->name("get_video");
	Route::get("get_still.php", [API\CdnController::class, "getStill"])->name("get_still");
	
	// Routes that need to be authenticated
	Route::group(["middleware" => "auth"], function() {
		
		// Temporary uploader routes
		Route::get("temp_uploader.php", [My\VideosController::class, "upload"])->name("temp_uploader");
		Route::post("temp_process.php", [My\VideosController::class, "process"])->name("temp_process");
		
		// Let the user log-out
		Route::any("logout.php", [AuthController::class, "doLogout"])->name("logout");
		
		// Profile settings
		Route::any("my_profile.php", [My\ProfileController::class, "process"])->name("my.profile");
		
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
			Route::any("outbox.php",          [My\MessagesController::class, "composeMessage"])->name("compose");
		});
		
	});
	
});