<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAddress;
use App\Models\Admin;
use App\Models\Province;
use Illuminate\Http\Request;


class AdminAddressAdminController extends Controller
{
 
    public function show(Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.index'); 

        $address = AdminAddress::where('admin_id',$admin->id)->firstOrCreate([
            'admin_id'=>$admin->id
        ]);

        $provinces = Province::orderBy('name','asc')->get();
 
       return  view('admin.admins.address',compact('address','admin','provinces'));
    }

    public function update(Request $request,Admin $admin,AdminAddress $address)
    {

        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.create'); 

        $request->validate(
        [
            'province' => ['required','integer'],
            'city' => ['required','integer'],
            'latitude' => ['nullable','max:255'],
            'longitude' => ['nullable','max:255'],
            'postalCode' => ['nullable','min:10','max:10'],
            'address' => ['nullable','max:255'],
        ],
        [
            "province.required" => "* الزامی است.",
            "city.required" => "* الزامی است.",
            "latitude.max" => "* حداکثر 255 کارکتر.",
            "longitude.max" => "* حداکثر 255 کارکتر.",
            "postalCode.min" => "* کدپستی 10 رقمی است.",
            "postalCode.max" => "* کدپستی 10 رقمی است.",
            "address.required" => "* الزامی است.",
            "address.max" => "* حداکثر 255 کارکتر.",
        ]);
 
        $address->provance_id = $request->province;
        $address->city_id = $request->city;
        $address->latitude = $request->latitude;
        $address->longitude = $request->longitude;
        $address->postalCode = $request->postalCode;
        $address->address = $request->address;
        $address->save();

        toast('آدرس ادمین بروزرسانی شد.','success')->position('bottom-end');        
        return redirect(route('admin.admins.index'));
    }

}
