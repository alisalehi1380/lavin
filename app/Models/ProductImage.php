<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class ProductImage extends Model
{
    protected $fillable=['product_id','name','alt','title','path'];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function getImagePath($size = 'original', $urlFormat = true)
    {
        $imageName =((array)json_decode($this->name))[$size];
        $path = $this->path ;
        $imagePath = $path . $imageName;
        return $urlFormat ? url($imagePath) : $imageName;
    }

    public function deleteImage()
    {
        $images = ((array)json_decode($this->name));
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
