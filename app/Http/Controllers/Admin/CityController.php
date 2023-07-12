<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Enums\Status;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Validator;
class CityController extends Controller
{
     
    public function index(Province $province)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.index');

         $cities = City::where('province_id',$province->id)->orderBy('name','asc')->get();
         return view('admin.provinces.city.all',compact('cities','province'));
    }

    
    public function create(Province $province)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.create');

        return view('admin.provinces.city.create',compact('province'));
    }

   
    public function store(Province $province,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.create');

        $city = City::where('province_id',$province->id)->where('name',$request->name)->first();
        if($city==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }
        
        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
        ],
        [
            "name.required" => "* الزامی است.",
            "name.max" => "* حداکثر طول مجاز  255 کارکتر است.",
            "name.unique_validator"=> "* این شهر قبلا برای این استان ثبت شده است.",
        ]);

        if($request->status==Status::Active || $request->status==Status::Deactive)
        {
            City::create([
                'name'=>$request->name,
                'slug'=>SlugService::createSlug(City::class, 'slug', $request->name),
                'province_id'=>$province->id,
                'status'=>$request->status,
            ]);

            toast('شهر جدید ثبت شد.','success')->position('bottom-end');        
        }

        return redirect(route('admin.provinces.cities.index',$province));
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit(Province $province,City $city)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.edit');

        return view('admin.provinces.city.edit',compact('province','city'));
    }

    
    public function update(Province $province,City $city,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.edit');

        $ct = City::where('province_id',$province->id)->where('name',$request->name)->where('id','<>',$city->id)->first();
        if($ct==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }
        
        $request->validate(
        [
            'name' => ['required','max:255','unique_validator'],
        ],
        [
            "name.required" => "* الزامی است.",
            "name.max" => "* حداکثر طول مجاز  255 کارکتر است.",
            "name.unique_validator"=> "* این شهر قبلا برای این استان ثبت شده است.",
        ]);

        if($request->status==Status::Active || $request->status==Status::Deactive)
        {
            $city->update([
                'name'=>$request->name,
                'slug'=>SlugService::createSlug(City::class, 'slug', $request->name),
                'status'=>$request->status,
            ]);

            toast('بروزرسانی انجام شد.','success')->position('bottom-end');        
        }

        return redirect(route('admin.provinces.cities.index',$province));
    }
 
    public function destroy($id)
    {
        //
    }
}
