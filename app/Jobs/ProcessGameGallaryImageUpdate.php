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

class ProcessGameGallaryImageUpdate implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $localImageUrls;
    protected $game;
    public function __construct($game, $localImageUrls)
    {
        $this->localImageUrls = $localImageUrls;
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newImgUrls = [];
        //Upload images to cloud storage 
        foreach($this->localImageUrls as $localUrl){
            $url = CloudController::UploadFile($localUrl, env('CLOUD_IMAGES_DIR'));
            array_push ($newImgUrls, $url);
            LocalController::Delete($localUrl);
        }
        $oldImgUrls = explode("; ",$this->game->gallaryImages);
        //Set and save cloud image urls to database
        $this->game->fill([
            'gallaryImages'=>implode("; ",$newImgUrls)
        ]);
        $this->game->save();
        
        //Delete Local Image
        foreach($oldImgUrls as $oldUrl){
            if(isset($oldUrl) && !in_array($oldUrl,$newImgUrls)){
                CloudController::Delete($oldUrl, false, true);
            }
        }
    }
}
