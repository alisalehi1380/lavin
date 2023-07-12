<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Enums\Status;
use App\Services\ReserveService;
use App\Services\SMS;
use Auth;

class ServiceController extends Controller
{
   private $reserveService;

   public function __construct()
   {
      $this->reserveService = new ReserveService();
   }

   public function index()
   {
       $pageServices = Service::with('details')->where('status',Status::Active)->paginate(5);
       return view('website.services.index',compact('pageServices'));
   }

   public function show($slug)
   {
      $service = ServiceDetail::with('images','doctors','videos.poster','service.details','reserves.review')->where('slug',$slug)->where('status',Status::Active)->first();
     
      return view('website.services.show',compact('service'));
   }

   public function reserve($service,$detail,Request $requast)
   {
      $detail = ServiceDetail::with('doctors')->find($detail);

      if(in_array($requast->doctor_id,$detail->doctors->pluck('id')->toArray()))
      {
         $this->reserveService->reserve(Auth::id(),$service,$detail->id,$requast->doctor_id);
        
         //ارسال sms
         $sms = new SMS;
         $text = Auth::user()->firstname.' '.Auth::user()->lastname." عزیز\nسرویس شما رزرو شد.\nجهت هماهنگی زمان مراجعه با شما تماس حاصل می شود.\nکلینیک لاوین رشت";
         $sms->send(array(Auth::user()->mobile),$text);
        
          alert()->success('تبریک','سرویس شما رزرو شد.جهت هماهنگی زمان مراجعه به زودی با شما تماس حاصل خواهد شد.');
         return back();
      }
      else
      {
         alert()->error('خطا!','پزشک مورد نظر را نتخاب کنید');
         return back();
      }
      
   }
}
