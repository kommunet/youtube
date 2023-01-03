<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

use App\Formats\FLV;

use App\Helpers\YouTube;

use App\Models\User;
use App\Models\Tag;
use App\Models\Video;

class ProcessVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	
	private $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(object $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		// For easy access
		$data = $this->data;
		
        // Get the runtime of the file
		$runtime = \FFMpeg::fromDisk('processing_videos')
						  ->open($data->file)
						  ->getStreams()[0]
						  ->get('duration');
		
		// Probably an invalid video file...
		if(!$runtime)
			return $this->batch()->cancel(); // Cancel the job
		
		// Set videos to 30 FPS
		$framerate = new \FFMpeg\Coordinate\FrameRate(30);
		$v_fps = new \FFMpeg\Filters\Video\FrameRateFilter($framerate, 12);
		
		// Set an FLV format with a low video and audio bitrate
		$v_format = (new Flv)->setKiloBitrate(200)
							 ->setAudioKiloBitrate(80);
		
		// Set our audio sampling rate
		$a_samplerate = new \FFMpeg\Filters\Audio\AudioResamplableFilter(22050);
		
		// Open from POST form
		\FFMpeg::fromDisk('processing_videos')
			   // Open the video
			   ->open($data->file)
			   
			   // Add framerate and samplerate filters
			   ->addFilter($v_fps)
			   ->addFilter($a_samplerate)
			   
			   // Tell FFMpeg to export
			   ->export()
			   
			   // Save to videos disk
			   ->toDisk('videos')
			   
			   // Specify for our custom FLV format
			   ->inFormat($v_format)
			   
			   // Resize to 240p
			   ->resize(320, 240)
			   
			   // Save video file
			   ->save($data->video_id.'.flv')
			   
			   // Export 3 different frames
			   ->exportFramesByAmount(4, 120, 90)
			   
			   // Save to thumbnails disk
			   ->toDisk('thumbnails')
			   
			   // Save them accordingly
			   ->save($data->video_id.'_%d.jpg');
		
		// Weird fix but more accurate thumbnail selection
		$thumbnails = Storage::disk("thumbnails");
		$thumbnails->delete($data->video_id."_1.jpg");
		
		// Rename the thumbnails
		$thumbnails->move($data->video_id."_2.jpg", $data->video_id."_1.jpg");
		$thumbnails->move($data->video_id."_3.jpg", $data->video_id."_2.jpg");
		$thumbnails->move($data->video_id."_4.jpg", $data->video_id."_3.jpg");
		
		// Remove the temporary video file
		Storage::disk('processing_videos')->delete($data->file);
		
		// Add the video to the database
		Video::create([
			"video_id"    => $data->video_id,
			"title"       => $data->title,
			"description" => $data->description,
			"uploader"    => $data->uploader,
			"tags"        => $data->tags,
			"runtime"     => $runtime,
		]);
		
		// Get the user
		$user = User::where("username", $data->uploader);
		
		// Update the user's latest video
		$user->update(["latest_video" => $data->video_id]);
		
		// Increment the number of public videos
		$user->increment("num_public_videos", 1);
		
		// Add the tags into the DB for use in search and homepage
		foreach(explode(" ", $data->tags) as $tag)
			Tag::create(["tag" => $tag, "video_id" => $data->video_id]);
    }
}
