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

    public static function Delete($filePath){
        $contents = Storage::get($filePath);
        if($contents['type'] == 'dir'){
            Storage::deleteDirectory($filePath);
        }else{
            Storage::delete($filePath);
        }
    }
}
