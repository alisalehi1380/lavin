<?php
namespace App\Services;
use App\Models\Notification;

class NotificationService
{

  public function send($title,$message,$status,$audience)
  {
     
   $notification = Notification::create([
      'title'=>$title,
      'message'=>$message,
      'status'=>$status
    ]);


    $notification->users()->sync($audience);
  }

    

}
