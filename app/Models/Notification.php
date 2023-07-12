<?php

namespace App\Models;
use Morilog\Jalali\CalendarUtils;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\seenStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use \Morilog\Jalali\Jalalian;
use App\Helpers\Helper;

class Notification extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','message','status'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function seen()
    {
        return $this->belongsToMany(User::class)->where('seen',seenStatus::seen);
    }

    public function created_at()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d - H:i:s',strtotime($this->created_at)));
    }

    public function seenStatus()
    {
        return DB::table('notification_user')->where('notification_id',$this->id)->where('user_id',Auth::id())->first()->seen;
    }

    public function scopeFilter($query)
    {
        $title = request('title');
        if(isset($title) && $title!='')
        {
            $query->where('title','like','%'.$title.'%');
        }

        $seen = request('seen');
        if(isset($seen) && $seen!='')
        {
            $query->whereHas('users',function($q) use($seen){
               $q->WhereIn('seen',$seen);
            });
        }
        
       //فیلتر از  تاریخ ثبت ناتیفیکیش
       $since = request('since');
       if(isset($since) &&  $since!='')
       {
           $since =  faToEn($since);
           $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d");
           $query->where('created_at','>=',$since);
       }
        
       //فیلتر تا  تاریخ ثبت ناتیفیکیش
       $until = request('until');
       if(isset($until) &&  $until!='')
       {
           $until =  faToEn($until);
           $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d");
           $query->where('created_at','<=',$until);
       }


       return $query;
    }
}
