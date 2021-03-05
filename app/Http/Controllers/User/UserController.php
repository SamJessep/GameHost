<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    public function index($username){
        $user = DB::select('select * from users where username = ?',[$username]);
        if($user){
            return view('web.user.user', ['user'=>$user[0]]);
        }
        return view('web.errors.404');
    }

    public function edit($username){
        return view('web.user.edit', ['user'=>Auth::user()]);
    }

    public function saveEdits(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'about' => 'max:500'
        ]);

        $user->fill([
            'name'=>$request->name,
            'username'=>$request->username,
            'about'=>$request->about ?? '',
            'isDev'=>$request->isDev ? true : false
        ]);
        $user->save();
        return redirect()->route('user', ['username'=>$user->username]);
    }

    public function storePicture(Request $request){
        $user = Auth::user();
        $current_time = \Carbon\Carbon::now()->timestamp;
        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'image' => 'mimes:jpeg,png|max:625000',
                ]);
                $extension = $request->image->extension();
                $request->image->storeAs('/public', $user->id."-".$current_time.".".$extension);
                $url = Storage::url($user->id."-".$current_time.".".$extension);
                //Delete old profile picture
                if(File::exists($user->picture)) {
                    File::delete($user->picture);
                }
                $user->picture = $url;
                $user->save();
                return Redirect::back();
            }
        }
        return Redirect::back();
        //abort(500, 'Could not upload image :(');
    }

    public function RemoveProfile(){
        $user = Auth::user();
        $user->picture = 'images/noProfile.png';
        $user->save();
        return redirect()->route('edit-user');
    }

    public function storeResetEmail(Request $request) {
            $request->validate(['email' => 'required|email']);
          
            $status = Password::sendResetLink(
                $request->only('email')
            );
          
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
    }

    public function forgotPassword(){
        return view('web.auth.forgot-password');
    }

    public function resetPassword($token){
        return view('web.auth.reset-password', ['token' => $token]);
    }

    public function updatePassword(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
    
                $user->setRememberToken(Str::random(60));
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    public function myGames(){
        return view('web.game.my-games');
    }
}
