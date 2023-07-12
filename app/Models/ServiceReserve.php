<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\PaymentStatus;

class ServiceReserve extends Model
{
   use SoftDeletes;
   
    protected $fillable = ['user_id','service_id','service_name','detail_id','detail_name','doctor_id','secratary_id','asistant_id','time','status'];

    public function user()
    {
       return $this->belongsTo(User::class); 
    }

    public function service()
    {
       return $this->belongsTo(Service::class); 
    }

    public function detail()
    {
       return $this->belongsTo(ServiceDetail::class); 
    }

    public function reviews()
    {
       return  $this->morphMany(Review::class,'reviewable');
    }

    public function doctor()
    {
       return $this->belongsTo(Admin::class,'doctor_id','id'); 
    }

    public function payment()
    {
        return $this->hasOne(ReservePayment::class,'reserve_id');
    }

    public function review()
    {
       return  $this->morphOne(Review::class,'reviewable');
    }

    public function reserve_time()
    {
      return Jalalian::forge($this->created_at)->format('d %B Y ساعت H:i');
    }

    public function round_time()
    {
      return Jalalian::forge($this->time)->format('d %B Y ساعت H:i');
    }

    public function round_time2()
    {
      return Jalalian::forge($this->time)->format('Y/m/d H:i');
    }

    public function paid()
    {
        if($this->payment == null || $this->payment->status != PaymentStatus::paid)
        {
            return false;
        }
        return true;
    }
    
    public function scopeFilter($query)
    {
       $user = request('user');
       if(isset($user) && $user!='')
       {
            $query->whereHas('user',function($q) use($user){
               $q->where('name','like','%'.$user.'%')->orWhere('mobile','like','%'.$user.'%');
            });
       }

       $levels = request('levels');
       if(isset($levels) && $levels!='')
       {
            $query->whereHas('user',function($q) use($levels){
               $q->whereIn('level_id',$levels);
            });
       }

       $services = request('services');
       if(isset($services) && $services!='')
       {
            $query->whereIn('service_id',$services);
       }

       
       $doctors = request('doctors');
       if(isset($doctors) && $doctors!='')
       {
            $query->whereIn('doctor_id',$doctors);
       }

       $status = request('status');
       if(isset($status) && $status!='')
       {
            $query->whereIn('status',$status);
       }
       
      //فیلتر زمان رزرو از
      $since_reserve = request('since_reserve');
      if(isset($since_reserve) &&  $since_reserve!='')
      {
         $since_reserve =  faToEn($since_reserve);
         $since_reserve = Jalalian::fromFormat('Y/m/d H:i', $since_reserve)->toCarbon("Y-m-d H:i");
         $query->where('created_at','>=', $since_reserve);
      }
         
      
      //فیلتر زمان رزرو تا
      $until_reserve = request('since_reserve');
      if(isset($until_reserve) &&  $until_reserve!='')
      {
         $until_reserve =  faToEn($until_reserve);
         $until_reserve = Jalalian::fromFormat('Y/m/d H:i', $until_reserve)->toCarbon("Y-m-d H:i");
         $query->where('created_at','<=', $until_reserve);
      }


      //فیلتر زمان رزرو از
      $since = request('since');
      if(isset($since) &&  $since!='')
      {
         $since =  faToEn($since);
         $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d");
         $query->where('created_at','>=', $since);
      }
         
      
      //فیلتر زمان رزرو تا
      $until = request('until');
      if(isset($until) &&  $until!='')
      {
         $until =  faToEn($until);
         $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d");
         $query->where('created_at','<=', $until);
      }


         return $query;
    }
    
}
