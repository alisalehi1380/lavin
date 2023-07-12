<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable=['name','description'];



    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function scopeFilter($query)
    {
        //فیلتر براساس نام
        $name = request('name');
        if(isset($name) &&  $name!='')
        {
            $query->where('name','like', '%'.$name.'%');
        }

        //فیلتر براساس توضیحات
        $description = request('description');
        if(isset($description) &&  $description!='')
        {
            $query->where('description','like', '%'.$description.'%');
        }

        //فیلتر براساس دسترسی ها 
        $permissions = request('permissions');
        if(isset($permissions))
        {
            $query->whereHas('permissions',function($qry) use($permissions){

                $qry->whereIn('id',$permissions);

            });
        }
        
      
    }
    
}
