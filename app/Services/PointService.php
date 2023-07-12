<?php
namespace App\Services;
use App\Models\Level;
use App\Models\User;
use App\Enums\Status;
use App\Services\SMS;
class PointService
{

  public function update($user,$point)
  {
      $point = $user->point + $point;
      $level = Level::where('point','<=',$point)->where('status',Status::Active)->orderBy('point','desc')->first();
       
      $user->point= $point;
      if($level!=null && $user->level_id != $level->id)
      {
          $user->level_id= $level->id;
        //ارسال sms
         $msg = " سطح شما در لیست مشتریان کلینیک لاوین به سطح ".$level->title." ارتقاء یافت.\nکلینیک لاوین رشت";
         $sms = new SMS;
         $sms->send(array($user->mobile),$msg);
      }
      $user->save();
  }

  public function point($user_id,$service)
  {
     $user = User::find($user_id);
     
      //امتیاز کاربر
      if($service->point>0)
      {
          $this->update($user,$service->point);
      }

      //امتیاز معرف
      if($service->porsant>0 && $user->introduced!=null) 
      {
          $introduced = User::where('code',$user->introduced)->first();
          $this->update($introduced,$service->porsant);
      }
  }

    

}
