<?php

namespace App\Http\Controllers\Game;

use ZipArchive;
use App\Models\Games;
use App\Rules\validGameZip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function loadGame($gameName){
        $game = Games::where('name', $gameName)->first();
        return view('web.game.player',['game'=>$game]);
    }

    public function uploadGameForm(){
        //$this->UnZipFile('storage/tmpGames/5thGame/gameZip-1615249421.zip', 'storage/tmpGames/5thGame/');
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

        $request->validate([
            'gameZip' => ['required', new validGameZip],
        ]);

        //Upload zip file, unzip file, get url of unziped game
        $gameUrl = $this->StoreFile($request->gameZip, $request->name);
        $gameUrl = $this->UnZipFile($gameUrl, dirname($gameUrl));

        //Upload Preview Image and gallary images
        if($request->previewImage){
            $previewImageUrl = $this->StoreFile($request->previewImage, $request->name);
        }

        if($request->gallaryImages){
            $gallaryImages = [];
            foreach ($request->gallaryImages as $index=>$gallaryImage){
                array_push($gallaryImages, $this->StoreFile($gallaryImage, $request->name));
            }
        }

        Games::Create([
            'name' => $request->name,
            'author' => $user->username,
            'description' => $request->description,
            'gameUrl' => $gameUrl,
            'thumbnailImage' => $previewImageUrl,
            'gallaryImages' => implode('; ',$gallaryImages)
        ]);
        return redirect()->route('my-games');
    }

    private function StoreFile($file, $location){
        $folderName = implode('',explode(' ', $location));
        $url = $file->store('public/tmpGames/'.$folderName);
        return str_replace('public', 'storage',$url);
        return $url;
    }

    private function UnZipFile($zipPath, $savePath){
        while(!file_exists($zipPath));
        $zip = new ZipArchive;
        $res = $zip->open($zipPath);
        if ($res === TRUE) {
            $zip->extractTo($savePath);
            $zip->close();
        } else {
            echo 'doh!';
        }
        return $savePath;
    }
}
