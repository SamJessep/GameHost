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
use App\Jobs\NotifyUser\EmailUploadFailure;
use App\Jobs\NotifyUser\EmailUploadSuccess;
use App\Jobs\ProcessGameGallaryImageUpdate;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Throwable;

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
            $previewImageUrl = LocalController::StoreFile($request->previewImage, env('LOCAL_IMAGES_DIR'));
        }

        if($request->gallaryImages){
            $gallaryImagesUrls = [];
            foreach ($request->gallaryImages as $index=>$gallaryImage){
                array_push($gallaryImagesUrls, LocalController::StoreFile($gallaryImage, env('LOCAL_IMAGES_DIR')));
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

        //Start upload Batch job

        $batch = Bus::batch([
            new ProcessGameUpload($zipUrl, $game),
            new ProcessGameGallaryImageUpdate($game, $gallaryImagesUrls),
            new ProcessGameImageUpdate($game, $previewImageUrl)
        ])->then(function (Batch $batch) use($game) {
            EmailUploadSuccess::dispatch($game);
        })->catch(function (Batch $batch, Throwable $e) use($game) {
            EmailUploadFailure::dispatch($game, $e);
            GameController::DeleteGame($game->name);
        })->dispatch();
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
            ProcessGameUpload::dispatch($zipUrl, $game);
        }

        if($request->previewImage){
            $imgUrl = LocalController::StoreFile($request->previewImage, env('LOCAL_IMAGES_DIR'));
            ProcessGameImageUpdate::dispatch($game, $imgUrl);
        }

        if($request->gallaryImages){
            $imgUrls = [];
            foreach($request->gallaryImages as $imgUrl){
                array_push($imgUrls, LocalController::StoreFile($imgUrl, env('LOCAL_IMAGES_DIR')));
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
