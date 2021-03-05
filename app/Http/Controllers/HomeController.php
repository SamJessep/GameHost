<?php

namespace App\Http\Controllers;

use App\Models\Games;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    //
    public function index(){
        $games = Games::all();
        return view('web.landing.index', ['games'=>$games]);
    } 
}
