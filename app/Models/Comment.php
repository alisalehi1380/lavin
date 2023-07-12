<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\CalendarUtils;
use Creativeorange\Gravatar\Facades\Gravatar;

class Comment extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['fullname','email','comment','answer','approved','commentable_id','commentable_type'];
    
    public function commentable()
    {
        return $this->morphTo();
    }

    public function publish_date()
    {
       return CalendarUtils::convertNumbers(CalendarUtils::strftime('d %B Y',strtotime($this->created_at)));
    }



    public function scopeFilter($query)
    {
        //فیلتر وضعیت
        $approved = request('approved');
        if(isset($approved) &&  $approved!='')
        {
            $query->where('approved',$approved);
        }

    }
}
