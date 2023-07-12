<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ServiceDetail extends Model
{
    use SoftDeletes;
    use Sluggable;

    protected $fillable =['service_id','name','price','porsant','point','breif','desc','status'];

    public function service()
    {
        return $this->hasOne(Service::class,'id','service_id');
    }

    public function reserves()
    {
        return $this->hasMany(ServiceReserve::class,'detail_id','id');
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function videos()
    {
        return $this->hasMany(ServiceDetailVideo::class, 'detil_id');
    }

    public function luck()
    {
        return $this->morphOne(Luck::class, 'luckable');
    }

    public function doctors()
    {
        return $this->belongsToMany(Admin::class,'doctor_service','service_id','doctor_id');
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
