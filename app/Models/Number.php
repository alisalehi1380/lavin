<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    protected $fillable = ['user_id','name','mobile'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopeFilter($quary)
    {
        $name = request('name');
        if(isset($name) && $name != '')
        {
            $quary->where('name','like','%'.$name.'%');
        }

        $mobile = request('mobile');
        if(isset($mobile) && $mobile != '')
        {
            $quary->where('mobile','like','%'.$mobile.'%');
        }
 
    }
}
