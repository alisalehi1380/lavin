<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Models\CityPart;
use App\Enums\Status;
use Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PartController extends Controller
{ 
    public function index(Province $province,City $city)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.parts.index');

         $parts = CityPart::where('city_id',$city->id)->orderBy('name','asc')->get();
         return view('admin.provinces.city.part.all',compact('parts','province','city'));
    }

 
    public function create(Province $province,City $city)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.parts.create');

        return view('admin.provinces.city.part.create',compact('province','city'));
    }
   
    public function store(Province $province,City $city,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.parts.create');

        $pr = CityPart::where('city_id',$city->id)->where('name',$request->name)->first();
        if($pr==null)
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
            "name.unique_validator"=> "* این ناحیه قبلا برای این شهر ثبت شده است.",
        ]);

        if($request->status==Status::Active || $request->status==Status::Deactive)
        {
            CityPart::create([
                'name'=>$request->name,
                'slug'=>SlugService::createSlug(CityPart::class, 'slug', $request->name),
                'city_id'=>$city->id,
                'status'=>$request->status,
            ]);

            toast('ناحیه جدید ثبت شد.','success')->position('bottom-end');        
        }

        return redirect(route('admin.provinces.cities.parts.index',[$province,$city]));
    }

   
    public function show($id)
    {
        //
    }

  
    public function edit(Province $province,City $city,CityPart $part)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.parts.edit');

        return view('admin.provinces.city.part.edit',compact('province','city','part'));
    }

  
    public function update(Province $province,City $city,CityPart $part,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.cities.parts.edit');

        $pr = CityPart::where('city_id',$city->id)->where('name',$request->name)->where('id','<>',$part->id)->first();
        if($pr==null)
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
            "name.unique_validator"=> "* این ناحیه قبلا برای این شهر ثبت شده است.",
        ]);

        if($request->status==Status::Active || $request->status==Status::Deactive)
        {
            $part->update([
                'name'=>$request->name,
                'slug'=>SlugService::createSlug(CityPart::class, 'slug', $request->name),
                'city_id'=>$city->id,
                'status'=>$request->status,
            ]);

            toast('ناحیه جدید ثبت شد.','success')->position('bottom-end');        
        }

        return redirect(route('admin.provinces.cities.parts.index',[$province,$city]));
    }

    
    public function destroy($id)
    {
        //
    }
}
