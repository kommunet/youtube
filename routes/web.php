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
Route::get("/", function () { return view("home"); })->name("home");

// This group makes things look neat :)
Route::group(["prefix" => "/"], function() {
	
	// Routes outside of the groups generally don"t need authentication
	Route::get("profile.php", [ProfileController::class, "view"])->name("profile");
	
	// Routes for users not yet authenticated
	Route::group(["middleware" => "guest"], function () {
		Route::any("login.php",  [AuthController::class, "doLogin"])->name("login");
		Route::any("signup.php", [AuthController::class, "doSignup"])->name("signup");
	});
	
	// Routes that need to be authenticated
	Route::group(["middleware" => "auth"], function() {
		// Let the user log-out
		Route::any("logout.php", [AuthController::class, "doLogout"])->name("logout");
		
		// Profile settings
		Route::any("my_profile.php", [My\ProfileController::class, "process"])->name("my.profile");
		
		// Inbox routes
		Route::group(["as" => "inbox."], function () {
			Route::get("my_messages.php",      [My\MessagesController::class, "listReceived"])->name("received");
			Route::get("my_messages_sent.php", [My\MessagesController::class, "listSent"])->name("sent");
			Route::get("my_messages_view.php", [My\MessagesController::class, "viewMessage"])->name("view");
			Route::post("outbox.php",          [My\MessagesController::class, "composeMessage"])->name("compose");
		});
	});
	
});