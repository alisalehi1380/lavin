<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use SoftDeletes;
    protected $fillable=['title','point','status'];
    
    public function user()
    {
        return$this->belongsTo(User::class);
    }
}
