<?php
namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FunctionService
{

    public function upload($file)
    {
        $dt = Carbon::now()->format('Y-m-d');
        $dt =explode('-',$dt);
        $year = $dt[0];
        $mount = $dt[1];
        $day = $dt[2];

        $fileName = Str::random(20).'.'.$file->extension();
        $path = $file->storeAs('public/images/'.$year.'/'.$mount.'/'.$day, $fileName);
        return $year.'/'.$mount.'/'.$day.'/'.$fileName;
    }

    public function uploadFile($file)
    {
        $year = Carbon::now()->year;
        $path = "/upload/files/{$year}/";
        $filename = Str::random(20).'.'.$file->extension();
        $file->move(public_path($path),$filename);
        $file = $path.$filename;
        return $file;
    }

    function faToEn($string) 
    {
        return strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    }

    public function remove_ckeditor($texts, $destination)
    {
        $dbFileNames = array();

        foreach ($texts as $text)
        {
            $string = html_entity_decode($text);
            $doc = new DOMDocument();

            libxml_use_internal_errors(true);
            $doc->loadHTML( $string );
            $xpath = new DOMXPath($doc);
            $imgs = $xpath->query("//img");

            for ($i=0; $i < $imgs->length; $i++) 
            {
                $img = $imgs->item($i);
                $src = $img->getAttribute("src");
                array_push($dbFileNames, basename(str_replace(['\\', '"'], '', $src)));
            }
        }

        $files = Storage::disk('local')->allFiles();

        $storageFileNames = array();

        foreach ($files as $file)
        {
            array_push($storageFileNames, basename($file));
        }

        $deleteFiles = array_diff($storageFileNames, $dbFileNames);

        if(count($deleteFiles) != 0)
        {
            foreach ($deleteFiles as $name)
            {
                $file = Storage::path($destination . $name);
                if(file_exists($file))
                {
                    File::delete($file);
                }
            }
        }
    }

    

}
