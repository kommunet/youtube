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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
			$table->string('video_id');
			$table->text("title");
			$table->text("description")->nullable();
			$table->text("uploader");
			$table->integer("visibility")->default(2); // 0 = private, 1 = unlisted, 2 = public
			$table->biginteger("num_comments")->default(0);
			$table->biginteger("num_views")->default(0);
			$table->biginteger("num_ratings")->default(0);
			$table->biginteger("num_favorites")->default(0);
			$table->double("avg_rating")->default(5.0);
			$table->double("runtime");
			$table->text("tags");
			$table->text("misc")->default(json_encode([
				"date_recorded"    => null,
				"address_recorded" => null,
				"country"          => null,
			]));
			$table->timestamp("last_viewed")->nullable();
			$table->timestamp("last_featured")->nullable();
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
        Schema::dropIfExists('videos');
    }
};
