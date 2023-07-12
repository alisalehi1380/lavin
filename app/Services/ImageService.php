<?php


namespace App\Services;
use DOMDocument;
use DOMXPath;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Image;
use Carbon\Carbon;
 

class ImageService
{

    public function saveResizeImages(UploadedFile $file,$path,$name,$sizes=[])
    {
        $data = [];
        foreach ($sizes as $key=>$size)
        {
            $fileNameStore =  $size['w'].'-'.$size['h'].'-'.$name;
            $img = Image::make($file->getRealPath());
            $img->resize($size['w'], $size['h'])->save($path.$fileNameStore);
            $data[$key] = $fileNameStore;
        }
        return $data;
    }
    


    public function upload(UploadedFile $file,$sizes=[],$path)
    {
        $this->mkdir($this->path());
        $ext = $file->getClientOriginalExtension();
        $fileStoreName = rand(1000,10000).time().'.'.$ext;
        $image = $this->saveResizeImages($file,$path,$fileStoreName,$sizes);
        return $image;
    }

    public function remove(\App\Models\Image $image)
    {
        foreach($image->getName() as $imageName) {
            $file = storage_path('images' . DIRECTORY_SEPARATOR . $imageName);

            if (file_exists($file))
            {
                unlink($file);
            }
        }
    }
 
    public function path()
    {
        $dt = Carbon::now()->format('Y-m-d');
        $dt =explode('-',$dt);
        $year = $dt[0];
        $mount = $dt[1];
        $day = $dt[2];
        $path =  'images/'.$year.'/'.$mount.'/'.$day.'/';
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