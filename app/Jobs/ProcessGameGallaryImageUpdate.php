<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Data\CloudController;
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
        foreach($this->localImageUrls as $localUrl){
            array_push ($newImgUrls, CloudController::UploadFile($localUrl, env('CLOUD_IMAGES_DIR')));
        }
        $oldImgUrls = explode("; ",$this->game->gallaryImages);
        $this->game->fill([
            'gallaryImages'=>implode("; ",$newImgUrls)
        ]);
        $this->game->save();
        foreach($oldImgUrls as $oldUrl){
            if(dirname($oldUrl) == env('LOCAL_IMAGES_DIR')){
                //Delete Local
                LocalController::Delete($oldUrl);
            }else{
                //Delete Cloud
                CloudController::Delete($oldUrl, false, true);
            }
        }
    }
}
