<?php

namespace App\Exceptions;

use Exception;

class NoGameFound extends Exception
{
    protected $gameName;
    public function __construct($gameName){
        $this->gameName = $gameName;
    }

    public function render()
    {
        return response()->view('errors.no-game-found', ["gameName"=>$this->gameName], 404);
    }
}
