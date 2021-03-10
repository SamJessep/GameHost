<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CloudController extends Controller
{
    public static function UploadDirectory($dir){
        $directories = Storage::disk('local')->directories($dir);
        CloudController::UploadContent($dir, basename($dir));
        return "GameHostStorage/".basename($dir);
    }

    public static function UploadContent($localPath, $cloudPath, $uploadRootDir="/"){
        $res = Storage::cloud()->makeDirectory($cloudPath);
        $subDirectories = Storage::disk('local')->directories($localPath);
        $subFiles = Storage::disk('local')->files($localPath);
        $contents = collect(Storage::cloud()->listContents($uploadRootDir, false));
        $cloudDir = $contents->where('type', '=', 'dir')
                        ->where('filename', '=', basename($localPath))
                        ->first(); // There could be duplicate directory names!
        if ($cloudDir) {
            foreach($subDirectories as $subDir){
                CloudController::UploadContent($subDir, $cloudDir['path'].'/'.basename($subDir), $cloudDir['path']);
            }
            foreach($subFiles as $subFile){
                Storage::cloud()->put($cloudDir['path'].'/'.basename($subFile), Storage::get($subFile));
            }
        }
    }

    public static function ShareFile(){

    }
}
