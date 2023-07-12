<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminFeild extends Model
{
     protected $fillable=['admin_id','feild','level'];

     public function admin()
     {
         return $this->hasOne(Admin::class);
     }
}
