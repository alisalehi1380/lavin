<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use Sluggable;  
    protected $fillable = ['title','descriotion','before','after','poster','video','status'];
 

    public function before_img()
    {
        return $this->hasOne(Image::class,'id','before');
    }

    public function after_img()
    {
        return $this->hasOne(Image::class,'id','after');
    }

    public function poster_img()
    {
        return $this->hasOne(Image::class,'id','poster');
    }


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
   
}
