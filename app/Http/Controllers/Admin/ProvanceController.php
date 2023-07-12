<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Enums\Status;
use App\Models\City;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ProvanceController extends Controller
{
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.index');

        $provinces = Province::orderBy('name','asc')->get();
        return view('admin.provinces.all',compact('provinces'));
    }   

    
    public function edit(Province $provance)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.edit');

        return view('admin.provinces.edit',compact('provance'));
    } 

    public function update(Province $provance,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('provinces.edit');
        
   
        $request->validate(
        [
            'name' => ['required','max:255','unique:provinces,id,'.$provance->id],
        ],
        [
            "name.required" => "* الزامی است.",
            "name.max" => "* حداکثر طول مجاز  255 کارکتر است.",
            "name.unique"=> "* این استان قبلا ثبت شده است.",
        ]);

        if($request->status==Status::Active || $request->status==Status::Deactive)
        {
            $provance->name = $request->name;
            $provance->slug = SlugService::createSlug(Province::class, 'slug', $request->name);
            $provance->status = $request->status;
            $provance->save();

            toast('.بروزرسانی انجام شد','success')->position('bottom-end');        
        }
     
        return redirect(route('admin.provances.index'));
    } 

   
}
