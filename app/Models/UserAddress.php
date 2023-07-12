<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table= 'user_addresses';
    protected $fillable = ['user_id','province_id','city_id','part_id','address','postalcode'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function part()
    {
        return $this->belongsTo(CityPart::class,'id','part_id');
    }
}
