<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Image;


class Gallery extends Model
{
    use SoftDeletes;
    use Sluggable;  

    protected $table = "galleries";

    protected $fillable=[ 'name','slug','status'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function thumbnail()
    {
        return Image::where('imageable_type',get_class($this))->where('imageable_id',$this->id)->first();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
