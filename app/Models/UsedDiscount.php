<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedDiscount extends Model
{
    protected $fillable=['user_id','discount_id'];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
}
