<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminMedia;
use App\Models\Admin;
use  Validator;


class AdminMediaController extends Controller
{ 
    public function index(Admin $admin) 
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.index'); 

       $medias = AdminMedia::where('admin_id',$admin->id)->get();
       return view('admin.admins.medias.all',compact('admin','medias'));
    }

    
    public function create(Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.create'); 

        return view('admin.admins.medias.create',compact('admin'));
    }

     
    public function store(Request $request,Admin $admin)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.create'); 

        $fd = AdminMedia::where('admin_id',$admin->id)->where('name',$request->name)->first();
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
                'name' => ['required','max:255','unique_validator'],
                'link' => ['required','max:255']
            ],
            [
                'name.required' => '* الزامی است.',
                'name.max' => '* حداکثر 255 کارکتر.',
                'name.unique_validator' => '*  تکراری است.',
                'link.required' => '* الزامی است.',
                'link.max' => '* حداکثر 255 کارکتر.',
            ]
        );

        AdminMedia::create([
            'admin_id'=> $admin->id,
            'name'=>$request->name,
            'link'=>$request->link,
        ]);

        toast('شبکه اجتماعی جدید افزوده شد.','success')->position('bottom-end'); 
        return redirect(route('admin.admins.medias.index',$admin));
    }
 
    public function show($id)
    {
        //
    }

  
    public function edit(Admin $admin,AdminMedia $media)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.edit'); 
        
        return view('admin.admins.medias.edit',compact('admin','media'));
    }

 
    public function update(Request $request, Admin $admin,AdminMedia $media)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.edit'); 

        $fd = AdminMedia::where('admin_id',$admin->id)->where('name',$request->name)->where('id','<>',$media->id)->first();
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
                'name' => ['required','max:255','unique_validator'],
                'link' => ['required','max:255']
            ],
            [
                'name.required' => '* الزامی است.',
                'name.max' => '* حداکثر 255 کارکتر.',
                'name.unique_validator' => '*  تکراری است.',
                'link.required' => '* الزامی است.',
                'link.max' => '* حداکثر 255 کارکتر.',
            ]
        );

        $media->update([
            'name'=>$request->name,
            'link'=>$request->link,
        ]);

        toast('بروزرسانی انجام شد.','success')->position('bottom-end'); 
        return redirect(route('admin.admins.medias.index',$admin));
    }

 
    public function destroy(Admin $admin,AdminMedia $media)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('admins.destroy'); 

        $media->delete();
        toast('شبکه اجتماعی مورد نظر حذف شد.','error')->position('bottom-end'); 
        return back();
    }
}
