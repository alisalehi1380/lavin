<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\AdminFeild;
use  Validator;

class AdminFeildController extends Controller
{
    
    public function index(Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.index'); 

       $feilds = AdminFeild::where('admin_id',$admin->id)->get();
       return view('admin.admins.feilds.all',compact('admin','feilds'));
    }

 
    public function create(Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.create'); 

        return view('admin.admins.feilds.create',compact('admin'));
    }
 
    public function store(Request $request,Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.create'); 

        $fd = AdminFeild::where('admin_id',$admin->id)->where('feild',$request->feild)->first();
        if($fd==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }
 
        $request->validate(
            [
                'feild' => ['required','max:255','unique_validator'],
                'level' => ['required','max:255']
            ],
            [
                'feild.required' => '* الزامی است.',
                'feild.max' => '* حداکثر 255 کارکتر.',
                'feild.unique_validator' => '*  تکراری است.',
                'level.required' => '* الزامی است.',
                'level.max' => '* حداکثر 255 کارکتر.',
            ]
        );

        AdminFeild::create([
            'admin_id'=> $admin->id,
            'feild'=>$request->feild,
            'level'=>$request->level,
        ]);

        toast('رشته جدید افزوده شد.','success')->position('bottom-end'); 
        return redirect(route('admin.admins.feilds.index',$admin));
    }

 
    public function show($id)
    {
      
    }
 
    public function edit(Admin $admin,AdminFeild $feild)
    { 
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.edit'); 

        return view('admin.admins.feilds.edit',compact('admin','feild'));
    }

 
    public function update(Request $request,Admin $admin,AdminFeild $feild)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.edit'); 

                
        $fd = AdminFeild::where('admin_id',$admin->id)->where('feild',$request->feild)->where('id','<>',$feild->id)->first();
        if($fd==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }
 
        $request->validate(
            [
                'feild' => ['required','max:255','unique_validator'],
                'level' => ['required','max:255']
            ],
            [
                'feild.required' => '* الزامی است.',
                'feild.max' => '* حداکثر 255 کارکتر.',
                'feild.unique_validator' => '*  تکراری است.',
                'level.required' => '* الزامی است.',
                'level.max' => '* حداکثر 255 کارکتر.',
            ]
        );

        $feild->update([
            'feild'=>$request->feild,
            'level'=>$request->level,
        ]);

        toast('بروزرسانی انجام شد.','success')->position('bottom-end'); 
        return redirect(route('admin.admins.feilds.index',$admin));
    }
 
    public function destroy(Admin $admin,AdminFeild $feild)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.destroy'); 

                
        $feild->delete();
        toast('رشته مورد نظر حذف شد.','error')->position('bottom-end'); 
        return back();
    }
}
