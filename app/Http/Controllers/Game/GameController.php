<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function uploadGameForm(){
        return view('web.game.upload-game');
    }

    public function uploadGame(Request $request){

    }
}
