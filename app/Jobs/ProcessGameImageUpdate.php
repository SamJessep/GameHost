<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Data\CloudController;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessGameImageUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $newImgUrl = CloudController::UploadFile($this->localImageUrl, env('CLOUD_IMAGES_DIR'));
        $oldImgUrl = $this->game->thumbnailImage;
        $this->game->fill([
            'thumbnailImage'=>$newImgUrl
        ]);
        $this->game->save();
        if(dirname($oldImgUrl) == env('LOCAL_IMAGES_DIR')){
            //Delete Local
            LocalController::Delete($oldImgUrl);
        }else{
            //Delete Cloud
            CloudController::Delete($oldImgUrl, false, true);

        }
    }
}
