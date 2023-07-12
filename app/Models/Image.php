<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class Image extends Model
{
    protected $fillable = [
        'imageable_id',
        'imageable_type',
        'title',
        'alt',
        'name',
        'path'
    ];

    protected $casts = [
        'name' => 'array'
    ];

    public function imageable()
    {
        return $this->morphTo('imageable');
    }

    public function getImagePath($size = 'original')
    {
        $imageName = $this->name[$size];
        $path = '/'.$this->path ;
        $imagePath = url('/').$path . $imageName;
        return $imagePath;
    }

    public function getImageableId()
    {
        return $this->imageable_id;
    }

    public function getImageableType()
    {
        return $this->imageable_type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getAlt()
    {
        return $this->alt;
    }

    public function getName()
    {
        return $this->name;
    }

    public function destroyImage()
    {
        $images = $this->name;
        foreach ($images as $image)
        {
            $file = public_path($this->path.$image);
            if(file_exists($file))
            {
                File::delete($file);
            }
        }
        $this->delete();
        return back();
    }
}
