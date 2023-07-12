<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class AdminAddress extends Model
{
     protected $fillable=['admin_id','provance_id','city_id','latitude','longitude','postalCode','address'];

     public function admin()
     {
         return $this->hasOne(Admin::class);
     }

     public function provance()
     {
         return $this->hasOne(provance::class);
     }

     public function city()
     {
         return $this->hasOne(City::class);
     }
}
