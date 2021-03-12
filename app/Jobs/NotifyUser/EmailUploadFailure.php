<?php

namespace App\Jobs\NotifyUser;

use Throwable;
use App\Mail\UploadFailed;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class EmailUploadFailure implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $game;
    protected$error;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($game, Throwable $error)
    {
        $this->game = $game;
        $this->error = $error;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->game->authorUser();
        Mail::to($user)->send(new UploadFailed($this->game, $this->error));
    }
}
