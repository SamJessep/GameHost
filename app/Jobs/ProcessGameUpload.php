<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessGameUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $zipUrl;
    protected $game;
    public function __construct($zipUrl, $game)
    {
        $this->zipUrl = $zipUrl;
        $this->game = $game;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Upload zip file, unzip file, get url of unziped game
        $extractedFolderUrl = LocalController::UnZipFile($this->zipUrl, dirname($this->zipUrl));
        $gameUrl = CloudController::UploadDirectory($extractedFolderUrl);
        $this->game->fill([
            'gameUrl'=>$gameUrl,
            'uploadStatus'=>'uploaded'
        ]);
        $this->game->save();
        
    }
}
