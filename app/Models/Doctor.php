<?php

namespace App\Models;
use \Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['admin_id','code','codeStartDate','expireDate','speciality','desc','video'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function startDate()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d',strtotime($this->codeStartDate)));
    }

    public function expireDate()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d',strtotime($this->expireDate)));
    }
 

}
