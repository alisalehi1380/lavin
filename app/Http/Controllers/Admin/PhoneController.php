<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Enums\Status;


class PhoneController extends Controller
{
     
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('phones.index');

        $phones = Phone::orderBy('title','asc')->get();
        return view('admin.phones.all',compact('phones'));
    }

    
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('phones.create');

        return view('admin.phones.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('phones.create');

        $request->validate([
            'title'=> 'required|max:255',
            'phone'=> 'required|max:20'
        ],[
            'title.required'=>'* الزامی است.',
            'title.max'=>'* حداکثر 255 کارکتر',
            'phone.required'=>'* الزامی است.',
            'phone.max'=>'* حداکثر 20 کارکتر',
        ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            Phone::create([
                'title' => $request->title,
                'phone' => $request->phone,
                'status' => $request->status,
            ]);

            return redirect(route('admin.phones.index'));
        }
           
    }

 
    public function show($id)
    {
        //
    }

 
    public function edit(Phone $phone)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('phones.edit');

        return view('admin.phones.edit',compact('phone'));
    }

 
    public function update(Phone $phone,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('phones.edit');


        $request->validate([
            'title'=> 'required|max:255',
            'phone'=> 'required|max:20'
        ],[
            'title.required'=>'* الزامی است.',
            'title.max'=>'* حداکثر 255 کارکتر',
            'phone.required'=>'* الزامی است.',
            'phone.max'=>'* حداکثر 20 کارکتر',
        ]);


        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $phone->update([
                'title' => $request->title,
                'phone' => $request->phone,
                'status' => $request->status,
            ]);

            return redirect(route('admin.phones.index'));
        }
    }

   
    public function destroy(Phone $phone)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('phones.delete');


        $phone->delete();
        return redirect(route('admin.phones.index'));
    }
}
