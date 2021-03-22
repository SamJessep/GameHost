<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        session(['url.intended' => url()->previous()]);
        return view('web.auth.register');
    }


    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'isDev'=>$request->isDev == 'on'
        ]);

        if(!auth()->attempt($request->only('username', 'password'))){
            return back()->with('status', 'invalid login details');
        }
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }
}
