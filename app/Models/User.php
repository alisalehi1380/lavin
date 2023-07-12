<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Creativeorange\Gravatar\Facades\Gravatar;
use Morilog\Jalali\Jalalian;
use App\Models\Discount;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','mobile','verify_code','verify_expire','verified','gender','code','introduced',
        'point','email','level_id','email_verified_at','password','token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function discounts()
    {
        return $this->belongsToMany(Discount::class);
    }

    public function usedDiscount()
    {
        return $this->HasMany(DiscountUsed::class);
    }

    public function cart()
    {
        return $this->HasMany(Cart::class);
    }

    public function reserves()
    {
        return $this->HasMany(ServiceReserve::class);
    }

    public  function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function address()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function bank()
    {
        return $this->hasOne(UserBank::class);
    }

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function numbers()
    {
        return $this->hasMany(Number::class);
    }

    public function email()
    {
        if($this->info==null)
        {
            return '-@gmail.com';
        }

        return  $this->info->email;
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function discountsNumber()
    {
        return   Discount::whereHas('users',function($q){
            $q->where('user_id',$this->id);
        })->whereDoesntHave('usedDiscount')->count();
    }

    public function scopeFilter($quary)
    {
        $name = request('name');
        if(isset($name) && $name != '')
        {
            $quary->where('firstname','like','%'.$name.'%')->orWhere('lastname','like','%'.$name.'%');
        }

        $mobile = request('mobile');
        if(isset($mobile) && $mobile != '')
        {
            $quary->where('mobile',$mobile );
        }

        $code = request('code');
        if(isset($code) && $code != '')
        {
            $quary->where('code',$code );
        }

        $introduced = request('introduced');
        if(isset($introduced) && $introduced != '')
        {
            $quary->where('introduced',$introduced );
        }

        //فیلتر براساس جنسیت
        $gender = request('gender');
        if(isset($gender) &&  $gender!='')
        {
            $quary->WhereIn('gender',$gender);
        }

        //فیلتر براساس سطح
        $levels = request('levels');
        if(isset($levels) &&  $levels!='')
        {
            $quary->WhereIn('level_id',$levels);
        }


        //فیلتر براساس ایمیل
        $email = request('email');
        if(isset($email) && $email != '')
        {
            $quary->whereHas('info',function($q) use($email){
                $q->where('email',$email);
            });
        }

       //فیلتر براساس شماره ملی
        $nationcode = request('nationcode');
        if(isset($nationcode) && $nationcode != '')
        {
            $quary->whereHas('info',function($q) use($nationcode){
                $q->where('nationcode',$nationcode);
            });
        }

        //فیلتر تاریخ ثبت نام از
        $since = request('since');
        if(isset($since) &&  $since!='')
        {
            $since =  faToEn($since);
            $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d H:i");
            $quary->where('created_at','>=',$since);
        }

         //فیلتر تاریخ ثبت نام تا
        $until = request('until');
        if(isset($until) &&  $until!='')
        {
            $until =  faToEn($until);
            $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d H:i");
            $quary->where('created_at','<=',$until);
        }

    }
}
