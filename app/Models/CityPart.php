<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class CityPart extends Model
{
    protected $table="city_parts";
    use Sluggable;
    public $timestamps = false;
    protected $fillable = ['city_id','name','slug','status'];

    public function address()
    {
        return $this->hasMany(Address::class);
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
