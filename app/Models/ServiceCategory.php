<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class ServiceCategory extends Model
{
    use SoftDeletes;
    use Sluggable;
 
    protected $fillable = ['parent_id','name','slug','status'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function parentServices()
    {
        return $this->hasMany(Service::class,'parent','parent_id');
    }

    
}
