<?php

namespace App\Http\Controllers\Game;

use ZipArchive;
use App\Models\Games;
use App\Rules\validGameZip;
use Illuminate\Http\Request;
use App\Jobs\ProcessGameUpload;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessGameImageUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessGameGallaryImageUpdate;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;

class GameController extends Controller
{
    public function loadGame($gameName){
        $game = Games::where('name', $gameName)->first();
        return view('web.game.player',['game'=>$game]);
    }

    public function uploadGameForm(){
        return view('web.game.upload-game');
    }

    public function uploadGame(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255|unique:App\Models\Games,name',
            'description' => 'max:1000',
            'gameZip' => 'file|max:50000',
            'previewImage' => 'required|image|max:5000',
            'gallaryImages' => 'max:50000'
        ]);

        $request->validate([
            'gameZip' => ['required', new validGameZip],
        ]);

        $zipUrl = LocalController::StoreFile($request->gameZip, 'tmpGames\\'.$request->name);
        //Upload Preview Image and gallary images
        if($request->previewImage){
            $previewImageUrl = LocalController::StoreFile($request->previewImage, 'tmpImages\\'.$request->name);
        }

        if($request->gallaryImages){
            $gallaryImagesUrls = [];
            foreach ($request->gallaryImages as $index=>$gallaryImage){
                array_push($gallaryImagesUrls, LocalController::StoreFile($gallaryImage, 'tmpImages\\'.$request->name));
            }
        }
        
        $game = Games::Create([
            'name' => $request->name,
            'author' => $user->username,
            'description' => $request->description,
            'thumbnailImage' => $previewImageUrl,
            'gallaryImages' => implode('; ',$gallaryImagesUrls),
            'status' => 'ready for upload'
        ]);
        ProcessGameUpload::dispatch($zipUrl, $game);
        ProcessGameGallaryImageUpdate::dispatch($game, $gallaryImagesUrls);
        ProcessGameImageUpdate::dispatch($game, $previewImageUrl);
        return redirect()->route('submit-success');
    }

    public function SubmitSuccess(){
        return view('web.game.upload-success');
    }

    public function EditGame($gameName){
        $game = Games::where('name', $gameName)->first();
        return view('web.game.edit-game', ["game"=>$game]);
    }

    public function UpdateGame($gameName, Request $request){
        //dd($gameName,$request->gameZip);
        $user = Auth::user();
        $game = Games::where('name', $gameName)->first();
        
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:1000',
            'gameZip' => 'file|max:50000',
            'previewImage' => 'image|max:5000',
            'gallaryImages' => 'max:50000'
        ]);

        $game->fill([
            'name'=>$request->name,
            'description'=>$request->description
        ]);
        $game->save();

        if($request->gameZip){
            //Upload new zip, unzip, upload to cloud, store old folder to delete, replace db urls, delete old files
            $zipUrl = LocalController::StoreFile($request->gameZip, 'tmpGames\\'.$request->name);
        }

        if($request->previewImage){
            $imgUrl = LocalController::StoreFile($request->previewImage, 'tmpGames\\'.$request->name);
            ProcessGameImageUpdate::dispatch($game, $imgUrl);
        }

        if($request->gallaryImages){
            $imgUrls = [];
            foreach($request->gallaryImages as $imgUrl){
                array_push($imgUrls, LocalController::StoreFile($imgUrl, 'tmpGames\\'.$request->name));
            }
            ProcessGameGallaryImageUpdate::dispatch($game, $imageUrls);
        }

        return view('web.game.edit-game', ["game"=>$game]);
    }

    public function DeleteGame($gameName){
        Games::where('name', $gameName)->first()->delete();
        return redirect()->route('my-games');
    }


}
