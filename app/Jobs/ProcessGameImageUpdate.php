<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessGameImageUpdate implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $localImageUrl;
    protected $game;
    public function __construct($game, $localImageUrl)
    {
        $this->localImageUrl = $localImageUrl;
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Upload images to cloud storage
        $newImgUrl = CloudController::UploadFile($this->localImageUrl, env('CLOUD_IMAGES_DIR'));
        $oldImgUrl = $this->game->thumbnailImage;
        //Save Cloud image urls to database
        $this->game->fill([
            'thumbnailImage'=>$newImgUrl
        ]);
        $this->game->save();
        if(isset($oldImgUrl) && $oldImgUrl == $newImgUrl){
            //Delete old Cloud image
            CloudController::Delete($oldImgUrl, false, true);
        }
        //Delete Local
        LocalController::Delete($this->localImageUrl);
    }
}
