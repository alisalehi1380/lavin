<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Morilog\Jalali\Jalalian;
use Morilog\Jalali\CalendarUtils;

class UserInfo extends Model
{
    protected $table="user_infos";

    protected $fillable = ['user_id','job_id','email','nationcode','birthDate','married','marriageDate'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function birth_date()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d',strtotime($this->birthDate)));
    }

    public function marriage_date()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('Y/m/d',strtotime($this->marriageDate)));
    }
    
}
