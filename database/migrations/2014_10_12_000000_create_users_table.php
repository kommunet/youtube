<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->boolean('is_moderator')->default(false);
			$table->boolean('is_administrator')->default(false);
			$table->text('profile')->default(json_encode([
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
			$table->biginteger("num_public_videos")->default(0);
			$table->biginteger("num_private_videos")->default(0);
			$table->biginteger("num_friends")->default(0);
			$table->biginteger("num_favorites")->default(0);
			$table->biginteger("num_subscribers")->default(0);
			$table->biginteger("num_playlists")->default(0);
			$table->biginteger("num_video_views")->default(0);
			$table->biginteger("num_profile_views")->default(0);
			$table->biginteger("num_videos_watched")->default(0);
			$table->string("latest_video")->nullable();
			$table->timestamp("last_viewed")->nullable(); // for profiles
			$table->timestamp("last_online")->nullable();
			$table->timestamp('last_login')->nullable();
			$table->text("register_ip");
			$table->text("last_login_ip");
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
