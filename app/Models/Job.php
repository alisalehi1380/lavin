<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Job extends Model
{
    use SoftDeletes;
     protected $fillable=['title','status'];

     public function info()
    {
        return $this->hasMany(UserInfo::class);
    }
     
}
