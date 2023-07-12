<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Luck extends Model
{
    protected $fillable=['lucktable_id','lucktable_type','probability','discount'];

    public function lucktable()
    {
        return $this->morphTo();
    }

}
