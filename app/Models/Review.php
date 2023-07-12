<?php

namespace App\Models;

use App\Services\ReserveService;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Review extends Model
{
    protected $fillable=['user_id','reviewable_type','reviewable_id','content','reviews'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviewable()
    {
        return $this->morphTo();
    }

    public function reserve()
    {
        return $this->belongsTo(ReserveService::class);
    }

    public function date()
    {
      return Jalalian::forge($this->created_at)->format('d %B Y');
    }

    public function scopeFilter($query)
    {
        $levels = request('levels');
        if(isset($levels) && $levels!='')
        {
             $query->whereHas('user',function($q) use($levels){
                $q->whereIn('level_id',$levels);
             });
        }
            
       //فیلتر تاریخ از
        $since = request('since');
        if(isset($since) &&  $since!='')
        {
            $since =  faToEn($since);
            $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d H:i");
            $query->where('created_at','>=',$since);
        }
 
       //فیلتر تاریخ تا
        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $until =  faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d H:i");
            $query->where('created_at','<=',$until);
        }

    }

}
