<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use SoftDeletes;
   protected $fillable = ["name","status"];

    public function ticket()
    {
        return $this->hasonde(Ticket::class);
    }

    public function department()
    {
        return $this->hasonde(Ticket::class);
    }
}
