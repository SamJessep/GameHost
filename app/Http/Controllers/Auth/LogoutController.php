<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    public function store(){
        auth()->logout();
        return redirect()->route('home');
    }
}
