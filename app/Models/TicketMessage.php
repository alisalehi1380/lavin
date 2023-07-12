<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use \Morilog\Jalali\CalendarUtils;

class TicketMessage extends Model
{
    use SoftDeletes;
    protected $fillable = ["ticket_id","content",'attach','sender_type','sender_id'];

    function ticket()
    {
        return $this->hasMany(Ticket::class);  
    }

    public function date()
    {
        return CalendarUtils::convertNumbers(CalendarUtils::strftime('l Y/m/d | H:i',strtotime($this->created_at)));
    }

}
