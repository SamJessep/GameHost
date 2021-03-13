<?php

namespace App\Http\Controllers\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Data\CloudController;

class CloudController extends Controller
{
    public static function UploadDirectory($dir){
        $directories = Storage::disk('local')->directories($dir);
        CloudController::UploadContent($dir, basename($dir));
        return basename($dir);
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
                CloudController::SaveFileWithMime($cloudDir['path'], Storage::path($subFile));
            }
        }
    }

    public static function SaveFileWithMime($cloudUrl, $localUrl){
        $mimes = new \Mimey\MimeTypes;
        // Return MIME type ala mimetype extension
        $finfo = finfo_open(FILEINFO_MIME_TYPE); 
        // Get the MIME type of the file
        $file_mime = finfo_file($finfo, $localUrl);

        // Convert extension to MIME type:
        $file_mime = $mimes->getMimeType(pathinfo($localUrl, PATHINFO_EXTENSION));
        finfo_close($finfo);
        $file_handle = fopen($localUrl, 'r');
        Storage::cloud()
            ->getDriver()
            ->put( 
                $cloudUrl.'/'.basename($localUrl),
                $file_handle,
                [
                    'visibility' => 'public',
                    'mimetype' => $file_mime
                ]
            );
        return $cloudUrl.'/'.basename($localUrl);
    }

    public static function UploadFile($localPath, $cloudPath){
        $idPath = CloudController::Path($cloudPath);
        CloudController::SaveFileWithMime($idPath, Storage::path($localPath));
        return $cloudPath.'/'.basename($localPath);
    }

    public static function ShareFile(){

    }

    public static function Delete($cloudPath, $isDir=false, $decoded=false){
        $cloudIDPath = $decoded ? $cloudPath : CloudController::Path($cloudPath);
        if($isDir){
            Storage::cloud()->deleteDirectory($cloudIDPath);
        }else{
            Storage::cloud()->delete($cloudIDPath);
        }
    }

    public static function Path($filePath){
        $locations = explode('/',$filePath);
        $path = "";
        foreach($locations as $location){
            $contents = collect(Storage::cloud()->listContents($path, false));
            $cloudDir = $contents
                ->where('name', '=', $location)
                ->first();
            $path = $path.$cloudDir['path'];
        }
        return $path;
    }
}
