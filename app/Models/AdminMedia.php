<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminMedia extends Model
{
    protected $fillable=['admin_id','name','link'];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
}
