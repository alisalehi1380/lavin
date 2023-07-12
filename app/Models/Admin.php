<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Image;
use Morilog\Jalali\Jalalian;

class Admin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'admin';

    protected $fillable = ['fullname','mobile','nationalcode','email','gender','password','status'];

    protected $hidden = ['password', 'remember_token'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);    
    }

    public function services()
    {
        return $this->belongsToMany(ServiceDetail::class,'doctor_service','doctor_id','service_id');
    }
 
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function get_image($size)
    {
        return url('/').'/'.$this->image->path.$this->image->name[$size];
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }


    public function hasRole($role)
    {
        if(is_string($role))
        {
            return $this->roles->contains('name',$role);
        }
 
        foreach($role as $r)
        {
            if($this->hasRole($r->name))
            {
                return true;
            }
        }

        return false; 
    }

    public function getPermissons()
    {
        $roles = $this->roles;
        $permissons = array();
        foreach($roles as $role)
        {
            foreach($role->permissions as $pr)
            {
                array_push($permissons,$pr->name);
            }
        }
        return $permissons;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        return $roles->pluck('name')->toArray();
    }

    public function scopeFilter($query)
    {
        //فیلتر براساس نام
        $fullname = request('fullname');
        if(isset($fullname) &&  $fullname!='')
        {
            $query->where('fullname','like', '%'.$fullname.'%');
        }

        //فیلتر براساس موبایل
        $mobile = request('mobile');
        if(isset($mobile) &&  $mobile!='')
        {
            $query->where('mobile','like', '%'.$mobile.'%');
        }

        //فیلتر براساس ایمیل
        $email = request('email');
        if(isset($email) &&  $email!='')
        {
            $query->where('email','like', '%'.$email.'%');
        }


        //فیلتر براساس نقش
        $roles = request('roles');
        if(isset($roles))
        {
            $query->whereHas('roles',function($qry) use($roles){
                $qry->whereIn('id',$roles);
            });
        }
        
        //فیلتر براساس وضعیت
        $status = request('status');
        if(isset($status))
        {
            $query->whereIn('status',$status);
        }

         //فیلتر تاریخ ثبت نام از
         $since = request('since');
         if(isset($since) &&  $since!='')
         {
             $since =  faToEn($since);
             $since = Jalalian::fromFormat('Y/m/d', $since)->toCarbon("Y-m-d H:i");
             $query->where('created_at','>=',$since);
         }
 
          //فیلتر تاریخ ثبت نام تا
         $until = request('until');
         if(isset($until) &&  $until!='')
         {
             $until =  faToEn($until);
             $until = Jalalian::fromFormat('Y/m/d', $until)->toCarbon("Y-m-d H:i");
             $query->where('created_at','<=',$until);
         }
 

         
   
    }
}
