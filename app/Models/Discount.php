<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UsedDiscount;
use Auth;
use Carbon\Carbon;

class Discount extends Model
{
    use SoftDeletes;
    
    protected $fillable=['code','unit','value','expire','status'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    
    public function services()
    {
        return $this->belongsToMany(ServiceDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function usedDiscount()
    {
        return $this->hasMany(UsedDiscount::class);
    }

    public function used()
    {
        return   UsedDiscount::where('discount_id',$this->id)->where('user_id',Auth::id())->exists();
    }

    public function expired()
    {
        if($this->expire!=null && $this->expire < Carbon::now()->format('Y-m-d H:i:s'))
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    public function scopeFilter($query)
    {
        //فیلتر کد تخفیف
        $code = request('code');
        if(isset($code) &&  $code!='')
        {
            $query->where('code',$code);
        }
    }
 
}
