<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){
        return view('web.auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|max:255',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('username', 'password'), $request->rememberMe)){
            return back()->with('status', 'invalid login details');
        }

        return redirect()->route('home');
    }
}
