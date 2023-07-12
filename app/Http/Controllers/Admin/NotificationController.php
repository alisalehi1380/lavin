<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Level;
use App\Enums\Status;
use Auth;
use  Validator;

class NotificationController extends Controller
{
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.index');

        $notifications = Notification::with('seen','users')->withTrashed()->filter()->orderBy('created_at','desc')->paginate(10);
        $users = User::orderBy('firstname','asc')->orderBy('lastname','asc')->get();
        return  view('admin.notification.all',compact('notifications','users'));
    }


    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.create');
        $users = User::orderBy('firstname','asc')->orderBy('lastname','asc')->get();
        $levels = Level::orderBy('point','asc')->get();
        return view('admin.notification.create',compact('users','levels'));
    }

    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.create');

        $audience = array();
        if(isset($request->users) && isset($request->levels))
        {
            $levels = User::whereIn('level_id',$request->levels)->pluck('id')->toArray();
            $audience = array_merge($levels,$request->users);
        }
        else if(isset($request->users))
        {
            $audience = $request->users;
        }
        else if(isset($request->levels))
        {
            $audience = User::whereIn('level_id',$request->levels)->pluck('id')->toArray();
        }
  
        if(count($audience)>0)
        {
 
            Validator::extend('audience_validator',function(){return true;});
            $audience = array_map('intval',$audience);
            $audience = array_unique($audience);
        }
        else
        {
            Validator::extend('audience_validator',function(){return false;});
        }


        $request->validate([
            'title'=>"required|max:255|audience_validator",
            'message'=>"required|max:63000",
        ],
        [
            'title.required'=>'* عنوان پیام است.',
            'title.max'=>'* حداکثر طول عنوان پیام 255 کارکتر.',
            'title.audience_validator'=>'* مخاطب را مشخص کنید.',
            'message.required'=>'* متن پیام است.',
            'message.max'=>'* حداکثر طول متن پیام 63000 کارکتر.',
        ]);
 
       if($request->status == Status::Active || $request->status ==Status::Deactive)
       {
         
           $notification = Notification::create([
                'title'=>$request->title,
                'message'=>$request->message,
                'status'=>$request->status,
            ]);
            
            $notification->users()->sync($audience);

            toast('اعلان جدید ثبت شد.','success')->position('bottom-end');
       }

       return redirect(route('admin.notifications.index'));
    }


    public function show(Notification $notification)
    {

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,Notification $notification)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.update');

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $notification->status = $request->status;
            $notification->save();
        }
        return back();
    }


    public function destroy(Notification $notification)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.destroy');

        $notification->delete();
        toast('اعلان مورد نظر حذف شد.','error')->position('bottom-end');
        return  redirect(route('notifications.index'));
    }

    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('notifications.destroy');

        
        $notification = Notification::withTrashed()->find($id);
        $notification->restore();
        toast('اعلان مورد نظر بازیابی شد.','error')->position('bottom-end');
        return back();
    }

    public function usersfetch()
    {
        $array =array();
        $levels = request('levels');
        $levels = explode(',',$levels);

         for($i=0;$i<count($levels);$i++)
         {
            array_push($array,$levels[$i]);
         }

        $users = User::whereIn('level_id',$array)->get();
        $selected = $users->pluck('id');

        return response()->json(['selected'=>$selected],200);
    }
}
