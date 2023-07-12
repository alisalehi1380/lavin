<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Card;
use Morilog\Jalali\CalendarUtils;
use \Morilog\Jalali\Jalalian;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id','price','discount_price','delivery_cost','total_price',
    'discount_id','token','full_name','address','mobile','delivery','res_code',
    'ref_id','sale_ref_id','msg','getway','status'];

    public function card()
    {
        return $this->hasMany(Card::class);
    }


    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function datetime()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('H:i:s - Y/m/d',strtotime($this->created_at)));
    }


    public function scopeFilter($query)
    {
        //فیلتر براساس مشتری
        $user = request('user');
        if(isset($user) &&  $user!='')
        {
            $query->whereHas('user',function($q) use($user){
                $q->where('firstname','like', '%'.$user.'%')
                ->orWhere('lastname','like', '%'.$user.'%')
                ->orWhere('mobile','like', '%'.$user.'%');
            }); 
        }

        $levels = request('levels');
        if(isset($levels) && $levels!='')
        {
             $query->whereHas('user',function($q) use($levels){
                $q->whereIn('level_id',$levels);
             });
        }

        //فیلتر شماره سفارش
        $res_code = request('res_code');
        if(isset($res_code) &&  $res_code!='')
        {
            $query->where('res_code',$res_code);
        }
 

        // فیلتر وضعیت پرداخت
        $pay = request('pay');
        if(isset($pay) &&  $pay!='')
        {
            $query->where('status',$pay);
        }
        
        // فیلتر وضعیت تحویل
        $delivery = request('delivery');
        if(isset($delivery) &&  $delivery!='')
        {
            $query->where('delivery',$delivery);
        }

       //فیلتر تاریخ سفارش
        $since = request('since');
        if(isset($since) &&  $since!='')
        {
            $since =  faToEn($since);
            $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d H:i");
            $query->where('created_at','>=',$since);
        }
 
       //فیلتر تاریخ سفارش
        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $until =  faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d H:i");
            $query->where('created_at','<=',$until);
        }

        $reciver = request('reciver');
        if(isset($reciver) && $reciver!='')
        {
             $query->where('full_name','like','%'.$reciver.'%')
             ->orWhere('address','like','%'.$reciver.'%')
             ->orWhere('mobile','like','%'.$reciver.'%'); 
        }
        
        return  $query;
   
    }
 
}