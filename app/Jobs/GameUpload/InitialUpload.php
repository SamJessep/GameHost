<?php

namespace App\Jobs\GameUpload;

use Illuminate\Bus\Queueable;
use App\Jobs\ProcessGameUpload;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ProcessGameImageUpdate;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\NotifyUser\EmailUploadFailure;
use App\Jobs\NotifyUser\EmailUploadSuccess;
use App\Jobs\ProcessGameGallaryImageUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Game\GameController;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class InitialUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $game;
    protected $zipUrl;
    protected $gallaryImagesUrls;
    protected $previewImageUrl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game, $zip, $gallary, $preview)
    {
        $this->game = $game;
        $this->zipUrl = $zip;
        $this->gallaryImagesUrls = $gallary;
        $this->previewImageUrl = $preview;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $batch = Bus::batch([
            new ProcessGameUpload($this->zipUrl, $this->game),
            new ProcessGameGallaryImageUpdate($this->game, $this->gallaryImagesUrls),
            new ProcessGameImageUpdate($this->game, $this->previewImageUrl)
        ])->then(function (Batch $batch) {
            EmailUploadSuccess::dispatch($this->game);
        })->catch(function (Batch $batch, Throwable $e) {
            EmailUploadFailure::dispatch($this->game, $e);
            GameController::DeleteGame($this->game->name);
        })->dispatch();

        return $batch->id;
    }
}
