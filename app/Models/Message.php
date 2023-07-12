<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\CalendarUtils;
use \Morilog\Jalali\Jalalian;
use App\Services\FunctionService;

class Message extends Model
{
    protected $fillable = ['fullname','mobile','content','seen'];

    public function created_at()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d - H:i:s',strtotime($this->created_at)));
    }

    public function scopeFilter($query)
    {
        //فیلتر براساس کاربر
        $user = request('user');
        if(isset($user) &&  $user!='')
        {
            $query->Where('mobile','like', '%'.$user.'%')->orWhere('fullname','like', '%'.$user.'%');
           
        }

        //فیلتر براساس وضعیت 
        $seen = request('seen');
        if(isset($seen) &&  $seen!='')
        {
            $query->WhereIn('seen',$seen);
        }

        //فیلتر زمان درج از
        $since = request('since');
        if(isset($since) &&  $since!='')
        {
            $fuctionService = new FunctionService;
            $since =  $fuctionService->faToEn($since);
            $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d");
            $query->where('created_at','>=', $since);
        }

        //فیلتر زمان درج تا
        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $fuctionService = new FunctionService;
            $until =  $fuctionService->faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d");
            $query->where('created_at','<=', $until);
        }
         
        return $query;
    }
 
}
