<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        session(['url.intended' => url()->previous()]);
        return view('web.auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'userId' => 'required|max:100',
            'password' => 'required'
        ]);

        $usernameFoundUser = User::where('username', $request->userId)->first();
        $email = $usernameFoundUser ? $usernameFoundUser->email : $request->userId;

        if(!Auth::attempt(['email' => $email, 'password' => $request->password], $request->remember)){
            return back()->with('status', 'invalid login details');
        }
        return redirect(session('url.intended'));
    }
}
