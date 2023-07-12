<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Enums\Status;
use App\Enums\seenStatus;
use Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('users')->where('status',Status::Active)->whereHas('users',function($q){
            $q->where('user_id',Auth::id());
        })->filter()->orderBy('created_at','desc')->paginate(10);
        $notifications = $notifications->appends(request()->query());
        return  view('crm.notification.all',compact('notifications'));
    }


    public function show(Notification $notification)
    {
        DB::table('notification_user')->where('notification_id',$notification->id)
        ->where('user_id',Auth::id())->update([
            'seen' => seenStatus::seen
        ]);

        return view('crm.notification.show',compact('notification'));
    }
}
