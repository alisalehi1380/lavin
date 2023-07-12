<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReserveUpgrade extends Model
{
    protected $fillable=['reserve_id','service_id','service_name','detail_id','detail_name',
    'price','asistant1_id','asistant2_id','desc','status'];

    public function service()
    {
       return $this->belongsTo(Service::class); 
    }

    public function detail()
    {
       return $this->belongsTo(ServiceDetail::class); 
    }

    public function asistant1()
    {
       return $this->belongsTo(Admin::class,'asistant1_id'); 
    }

    public function asistant2()
    {
       return $this->belongsTo(Admin::class,'asistant2_id'); 
    }

}
