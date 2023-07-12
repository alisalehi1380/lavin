<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleCategories extends Model
{
    use SoftDeletes;
    use Sluggable;

     protected $fillable=['name','slug','status'];
     

     public function articles()
     {
         return $this->belongsToMany(Article::class);
     }
 

     public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'name'
             ]
         ];
     }

     public function scopeFilter($query)
     {
        $name = request('name');
        if(isset($name) && $name!='')
        {
            $query->where('name','like','%'.$name.'%');
        }
     }
}
