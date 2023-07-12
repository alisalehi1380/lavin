<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    protected $table="user_banks";

    protected $fillable = ['user_id','name','title','account','shaba'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}


