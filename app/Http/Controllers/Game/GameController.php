<?php

namespace App\Http\Controllers\Game;

use Throwable;
use ZipArchive;
use App\Models\Games;
use Illuminate\Bus\Batch;
use App\Rules\validGameZip;
use Illuminate\Http\Request;
use App\Exceptions\NoGameFound;
use App\Jobs\ProcessGameUpload;
use Illuminate\Support\Facades\Bus;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessGameImageUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Jobs\NotifyUser\EmailUploadFailure;
use App\Jobs\NotifyUser\EmailUploadSuccess;
use App\Jobs\ProcessGameGallaryImageUpdate;
use App\Http\Controllers\Game\GameController;
use App\Http\Controllers\Data\CloudController;
use App\Http\Controllers\Data\LocalController;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GameController extends Controller
{
    public function loadGame($gameName){
        try{
            $game = Games::where('name', $gameName)->first();
            if(!$game) throw new NoGameFound($gameName);
            return view('web.game.player',['game'=>$game]);
        }catch(NoGameFound $e){
            return $e->render();
        }
    }


    public function uploadGameForm(){
        return view('web.game.upload-game');
    }

    public function uploadGame(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255|unique:App\Models\Games,name',
            'description' => 'max:10000',
            'gameZip' => 'file|max:150000',
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
            'description' => 'max:10000',
            'gameZip' => 'file|max:150000',
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
            ProcessGameGallaryImageUpdate::dispatch($game, $imgUrls);
        }

        return redirect()->route('my-games');
    }

    public function DeleteGame($gameName){
        Games::where('name', $gameName)->first()->delete();
        return redirect()->route('my-games');
    }

    public function ForwardStorageRequest(Request $request, $target){
        $request = Http::withHeaders([
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36',
            'accept'=> 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'accept-encoding'=>'gzip, deflate, br'
        ])->get(env('GAME_STORE_URL').$target);
        return response($request->body())
            ->header('Content-Type', $request->header('Content-Type'));
    }


}
