<?php

namespace App\Http\Controllers\User;
use App\Models\User;
use App\Models\Games;
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
use App\Http\Controllers\Data\CloudController;

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
            'username' => 'required|max:255|unique:App\Models\User,username,'.$user->username,
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

    public static function storePicture($picture, $localPath, $user){
        $current_time = \Carbon\Carbon::now()->timestamp;
        $extension = $picture->extension();
        $url = CloudController::UploadFile(
            $localPath,
            env('CLOUD_IMAGES_DIR')
        );
        //Delete old profile picture
        if(CloudController::FileExists($user->picture)) {
            CloudController::Delete($user->picture);
        }
        $user->picture=$url;
        $user->save();
        return $user;
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
        $user = Auth::user();
        $myGames = Games::where('author', $user->username)->get();
        return view('web.game.my-games', ['myGames'=>$myGames]);
    }
}
