<?php

namespace App\Http\Controllers\Data;

use ZipArchive;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LocalController extends Controller
{
    public static function StoreFile($file, $location){
        $folderName = implode('',explode(' ', $location));
        $url = $file->store($folderName);
        return $url;
    }


    public static function UnZipFile($zipPath, $savePath){
        $zipPath = Storage::disk('local')->path($zipPath);
        while(!file_exists($zipPath));
        $zip = new ZipArchive;
        $res = $zip->open($zipPath);
        if ($res === TRUE) {
            $zip->extractTo(Storage::disk('local')->path($savePath));
            $zip->close();
        } else {
            echo 'doh!';
        }
        return $savePath;
    }

    public static function Delete($relativePath){
        if(is_dir(Storage::path($relativePath))){
            Storage::deleteDirectory($relativePath);
        }else{
            Storage::delete($relativePath);
        }
    }

    public static function test(){
        $fp = "tmpGames/BLUE2";
        dd(dirname("tmpImages\CarRacer\8e48eTxG2P8Vd3Z5BHOPnE4xw1fx861OJvWgRRKw.png") == env('LOCAL_IMAGES_DIR'));
        dd(CloudController::Path("CarRacer"));
    }
}
