<?php

namespace App\Http\Controllers\Game;

use App\Models\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function uploadGameForm(){
        return view('web.game.upload-game');
    }

    public function uploadGame(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:1000',
            'gameZip' => 'file|max:50000',
            'previewImage' => 'required|image|max:5000',
            'gallaryImages' => 'max:50000'
        ]);
        $user = Auth::user();
        if($request->previewImage){
            $previewImageUrl = $this->StoreFile($request->previewImage, $request->name,'previewImage', $user);
        }
        if($request->gameZip){
            $gameUrl = $this->StoreFile($request->gameZip, $request->name,'gameZip', $user);
        }
        if($request->gallaryImages){
            $gallaryImages = [];
            foreach ($request->gallaryImages as $index=>$gallaryImage){
                array_push($gallaryImages, $this->StoreFile($gallaryImage, $request->name, 'gallary'.$index, $user));
            }
        }

        Games::Create([
            'name' => $request->name,
            'author' => $user->username,
            'description' => $request->description,
            'gameZip' => $gameUrl,
            'thumbnailImage' => $previewImageUrl,
            'gallaryImages' => implode('; ',$gallaryImages)
        ]);
        return redirect()->route('my-games');
    }

    private function StoreFile($image, $location, $filename, $user){
        $location = implode('',explode(' ', $location));
        $current_time = \Carbon\Carbon::now()->timestamp;
        $extension = $image->extension();
        $image->storeAs('public/tmpGames/'.$location.'/', $filename."-".$current_time.".".$extension);
        $url = Storage::url('public/tmpGames/'.$location.'/'.$filename."-".$current_time.".".$extension);
        return $url;
    }
}
