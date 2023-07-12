<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Socialmedia;
use App\Enums\Status;

class SocialmediaController extends Controller
{
   
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('socialmedia.index');

        $socialmedias = Socialmedia::orderby('name','asc')->get();
        return view('admin.socialmedia.all',compact('socialmedias'));
    }
 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('socialmedia.create');

        return view('admin.socialmedia.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('socialmedia.create');

        $this->validate($request,
        [
            'name' => ['required','max:255'],
            'link' => ['required','max:255'],
            'icon' => ['required','max:255'],
            'status' => ['required']
        ],
        [
            'name.required'=> '* عنوان شبکه اجتماعی الزامی است.',
            'name.max'=> '* حداکثر طول مجاز عنوان شبکه اجتماعی 255 کارکتر می باشد.',
            'link.required'=> '* لینک شبکه اجتماعی الزامی است.',
            'link.max'=> '* حداکثر طول مجاز لینک شبکه اجتماعی 255 کارکتر می باشد.',
            'icon.required'=> '* آیکن شبکه اجتماعی الزامی است.',
            'icon.max'=> '* حداکثر طول مجاز آیکن شبکه اجتماعی 255 کارکتر می باشد.',
            'status.required'=> '* اعلام وضعیت الزامی است.',
        ]);

        if($request->status == Status::Active ||  $request->status == Status::Deactive)
        {
            Socialmedia::create([
                "name" => $request->name,
                "link" => $request->link,
                "icon" => $request->icon,
                "status" => $request->status
            ]);
        }
   
        toastr()->success('شبکه اجتماعی جدید افزوده شد.');

        return redirect(route('admin.socialmedia.index'));
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit(Socialmedia $socialmedia)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('socialmedia.edit');
            
       return view('admin.socialmedia.edit',compact('socialmedia'));
    }

   
    public function update(Request $request, Socialmedia $socialmedia)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('socialmedia.edit');

        $this->validate($request,
        [
            'name' => ['required','max:255'],
            'link' => ['required','max:255'],
            'icon' => ['required','max:255'],
            'status' => ['required']
        ],
        [
            'name.required'=> '* عنوان شبکه اجتماعی الزامی است.',
            'name.max'=> '* حداکثر طول مجاز عنوان شبکه اجتماعی 255 کارکتر می باشد.',
            'link.required'=> '* لینک شبکه اجتماعی الزامی است.',
            'link.max'=> '* حداکثر طول مجاز لینک شبکه اجتماعی 255 کارکتر می باشد.',
            'icon.required'=> '* آیکن شبکه اجتماعی الزامی است.',
            'icon.max'=> '* حداکثر طول مجاز آیکن شبکه اجتماعی 255 کارکتر می باشد.',
            'status.required'=> '* اعلام وضعیت الزامی است.',
        ]);

        if($request->status == Status::Active ||  $request->status == Status::Deactive)
        {
            $socialmedia->update(
                [
                    "name"=> $request->name,
                    "link"=> $request->link,
                    "icon"=> $request->icon,
                    "status"=> $request->status,
                ]
            );
        }

        
        toastr()->info('بروزرسانی انجام شد.');

        return redirect(route('admin.socialmedia.index'));
    }

   
    public function destroy(Socialmedia $socialmedia)
    {
        $socialmedia->delete();
        toastr()->info('شبکه اجتماعی مورد نظر حذف شد.');
        return redirect(route('admin.socialmedia.index'));
    }
}
