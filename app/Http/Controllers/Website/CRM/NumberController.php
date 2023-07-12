<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Number;
use Auth;
use App\Services\PointService;
use App\Services\SMS;

class NumberController extends Controller
{
     public function create()
     {
        return view("crm.numbers.create");
     }

     public function store(Request $request)
     {
        $request->validate([
            "name"=>"required|max:255",
            'mobile'=>'required|min:11|max:11|regex:/^[0-9]+$/|unique:users|unique:numbers',
        ],
        [
            "name.required"=>"* نام و نام خانوادگی الزامی است",
            "name.max"=>"*  حداکثر 255 کارکتر",
            'mobile.required'=>'* شماره موبایل الزامی است.',
            'mobile.min'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.max'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.regex'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.unique'=>' شماره موبایل قبلا ثبت شده است',
        ]);


        Number::create([
            "user_id"=> Auth::id(),
            "name"=>$request->name,
            "mobile"=>$request->mobile,
        ]);
 
         //ارسال sms
         $msg = "شماره شما در سامانه کلینیک درمانگاه لاوین ثبت شد.\nلینک شرکت در قرعه کشی :\n". route('website.lottery.index')."\nکلینیک لاوین رشت";
         $sms = new SMS;
         $sms->send(array($request->mobile),$msg);

        //افزودن 2 امتیاز به کاربر
        $pointService = new PointService();
        $pointService->update(Auth::user(),2);

        alert()->success('تبریک','دو امتیاز به شما افزوده شد.');

        return back();
         
     }
}
