<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailController extends Controller
{
    public function VerifyEmailNotice(){
        return view('web.auth.verify-email',['email'=>Auth::user()->email]);
    }

    public function VeficationHandler(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home');
    }

    public function ResentVerificationEmail(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function UpdateEmail(Request $request){
        $request->validate([
            'email' => 'required|email|unique:App\Models\User,email',
        ]);
        $user = Auth::user();
        $user->email = $request->email;
        $user->save();
        $request->user()->sendEmailVerificationNotification();
        return redirect()->route('verification.notice');
    }
}
