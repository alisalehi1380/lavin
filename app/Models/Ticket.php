<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Enums\Part;
use \Morilog\Jalali\Jalalian;

class Ticket extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'department_id','admin_id','user_id','number','title','sender_type','sender_id','audience_type','audience_id','status','priority'
    ];


    function department()
    {
        return $this->belongsTo(Department::class);
    }

    function TicketMessage()
    {
        return $this->hasMany(TicketMessage::class)->orderBy('created_at','asc');
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    function scopeFilter($query)
    {
         //فیلتر نام
         $title = request('title');
         if(isset($title) &&  $title!='')
         {
             $query->where('title','like', '%'.$title.'%');
         }

          //فیلتر نام
          $number = request('number');
          if(isset($number) &&  $number!='')
          {
              $query->where('number','like', '%'.$number.'%');
          }
  
            //فیلتر اولویت
            $priority = request('priority');
            if(isset($priority) &&  $priority!='')
            {
                    $query->where('priority',$priority);
            }

            //فیلتر وضعیت
            $status = request('status');
            if(isset($status) &&  $status!='')
            {
                $query->where('status',$status);
            }

            //فیلتر واحد
            $department = request('department');
            if(isset($department) &&  $department!='')
            {
                $query->where('department_id',$department);
            }

    }

    function scopeFilterDashboard($query)
    {
          
         $since = request('since');
         //فیلتر تاریخ سفارش
         if(isset($since) &&  $since!='')
         {
             $since =  faToEn($since);
             $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d H:i:s");
             $query->where('created_at','>=',$since);
         }


        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $until =  faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d H:i:s");
            $query->where('created_at','<=',$until);
        }


        $levels = request('levels');
        if(isset($levels) && $levels!='')
        {
             $query->whereHas('user',function($q) use($levels){
                $q->whereIn('level_id',$levels);
             });
        }

    }

}
