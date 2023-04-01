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
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
			$table->text("title");
			$table->text("description");
			$table->string("latest_video_added")->nullable();
			$table->biginteger("num_videos_today")->default(0);
			$table->biginteger("num_videos_total")->default(0);
			$table->biginteger("num_groups_total")->default(0);
            $table->timestamps();
        });
		
		DB::table('channels')->insert([
			['id' => 1, 'title' => 'Arts & Animation', "description" => "Artistic, Computer Graphics, Anime...", "created_at" => now(), "updated_at" => now()],
			['id' => 2, 'title' => 'Autos & Vehicles', "description" => "Cars, Boats, Airplanes...", "created_at" => now(), "updated_at" => now()],
			['id' => 3, 'title' => 'Educational & Instructional', "description" => "Tutorials, Software Demos, Cooking Techniques...", "created_at" => now(), "updated_at" => now()],
			['id' => 4, 'title' => 'Events & Weddings', "description" => "Parties, Birthdays, Graduations...", "created_at" => now(), "updated_at" => now()],
			['id' => 5, 'title' => 'Entertainment', "description" => "Trailers, Commercials...", "created_at" => now(), "updated_at" => now()],
			['id' => 6, 'title' => 'Family', "description" => "Babies, Holidays, Memories...", "created_at" => now(), "updated_at" => now()],
			['id' => 7, 'title' => 'For Sale & Auctions', "description" => "eBay, Craigslist...", "created_at" => now(), "updated_at" => now()],
			['id' => 8, 'title' => 'Hobbies & Interests', "description" => "Haunted Dolls, Cooking, RC Planes...", "created_at" => now(), "updated_at" => now()],
			['id' => 9, 'title' => 'Humor', "description" => "Funny, Bloopers, Pranks...", "created_at" => now(), "updated_at" => now()],
			['id' => 10, 'title' => 'Music', "description" => "Dancing, Singing, Guitars...", "created_at" => now(), "updated_at" => now()],
			['id' => 11, 'title' => 'News & Politics', "description" => "Breaking News, Weather, Speeches...", "created_at" => now(), "updated_at" => now()],
			['id' => 12, 'title' => 'Odd & Outrageous', "description" => "Flips, Jumps, Unexplainable...", "created_at" => now(), "updated_at" => now()],
			['id' => 13, 'title' => 'People', "description" => "Celebrities, Hot Girls, Cool Guys...", "created_at" => now(), "updated_at" => now()],
			['id' => 14, 'title' => 'Personals & Dating', "description" => "Video Profiles, Interesting People...", "created_at" => now(), "updated_at" => now()],
			['id' => 15, 'title' => 'Pets & Animals', "description" => "Cats, Dogs, Fish, Zoo...", "created_at" => now(), "updated_at" => now()],
			['id' => 16, 'title' => 'Science & Technology', "description" => "Gadgets, Reviews, Space Shuttle...", "created_at" => now(), "updated_at" => now()],
			['id' => 17, 'title' => 'Sports', "description" => "Games, Stadiums, Tailgating...", "created_at" => now(), "updated_at" => now()],
			['id' => 18, 'title' => 'Short Movies', "description" => "Self Produced, Indie Films...", "created_at" => now(), "updated_at" => now()],
			['id' => 19, 'title' => 'Travel & Places', "description" => "Vacations, International, Nature...", "created_at" => now(), "updated_at" => now()],
			['id' => 20, 'title' => 'Video Games', "description" => "Demos, Previews...", "created_at" => now(), "updated_at" => now()],
			['id' => 21, 'title' => 'Videoblogging', "description" => "Blogs, Opinions, Diaries...", "created_at" => now(), "updated_at" => now()],
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
};
