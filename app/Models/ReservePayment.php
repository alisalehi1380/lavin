<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReservePayment extends Model
{
    protected $table="reserve_payments";

    protected $fillable = ['reserve_id','user_id','price','discount_price','total_price',
    'discount_id','token','res_code','ref_id','sale_ref_id','msg','gateway','payway','status'];

    public function reserve()
    {
        return $this->belongsTo(ServiceReserve::class,'reserve_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

}
