<?php

namespace App\Mail;

use Throwable;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadFailed extends Mailable
{
    use Queueable, SerializesModels;

    public $game;
    public $error;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($game, Throwable $error)
    {
        $this->game = $game;
        $this->error = $error;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($game->name." has failed to deploy")->view('mail.uploadFailed');
    }
}
