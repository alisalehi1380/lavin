<?php


namespace App\Services;


use DOMDocument;
use DOMXPath;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Video;
use Carbon\Carbon;


class VideoService
{

    public function upload(UploadedFile $file,$path)
    {
        $this->mkdir($this->path());
        $ext = $file->getClientOriginalExtension();
        $fileStoreName = rand(1000,10000).time().'.'.$ext;
        $file->move(public_path($path), $fileStoreName);
        return $path.'/'.$fileStoreName;
    }

    public function remove(\App\Models\Image $image)
    {
        $file = storage_path('videos' . DIRECTORY_SEPARATOR . $image->name);
        if (file_exists($file))
        {
            unlink($file);
        }
    }

    public function path()
    {
        $dt = Carbon::now()->format('Y-m-d');
        $dt =explode('-',$dt);
        $year = $dt[0];
        $mount = $dt[1];
        $day = $dt[2];
        $path =  'videos/'.$year.'/'.$mount.'/'.$day.'/';
        return $path;
    }
    
    public function mkdir($path)
    {
        $folders = explode('/',$path);
        $directory="";
        foreach($folders as $folder)
        {
              $target = $directory.$folder;
             if (!file_exists($target)) 
            {
                mkdir($target, 775, true);
                umask(0);
                chmod($target, 0755);
            }
            $directory .= $folder.'/';
        }
    }

}
