<?php

namespace App\Providers;

use App\Providers\GameReady;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReadyNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  GameReady  $event
     * @return void
     */
    public function handle(GameReady $event)
    {
        //
    }
}
