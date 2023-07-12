<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\CodeService;
use App\Services\PointService;
use App\Services\SMS;
use Auth;
use App\Enums\genderType;
use Carbon\Carbon; 

class RegisterController extends Controller
{
    private $code;
    public function __construct()
    {
        $this->code = new CodeService;
    }

    public function register(Request $request)
    {
       
        $request->validate([
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'mobile'=>'required|min:11|max:11|regex:/^[0-9]+$/|unique:users',
            'nationcode'=>'required|min:10|max:10|regex:/^[0-9]+$/|unique:users',
            'gender'=>'required',
            'introduced'=>'nullable|exists:users,code',
            "password"=>['required','max:255','min:6','confirmed','required_with:password_confirmation|same:password_confirmation'],
        ]
        ,
        [
            'firstname.required'=>'نام و نام خانوادگی الزامی است.',
            'firstname.max' => ' حداکثر طول نام و نام خانوادگی 255 کارکتر',
            'lastname.required'=>'نام و نام خانوادگی الزامی است.',
            'lastname.max' => ' حداکثر طول نام و نام خانوادگی 255 کارکتر',
            'mobile.required'=>'* شماره موبایل الزامی است.',
            'mobile.min'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.max'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.regex'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.unique'=>' شماره موبایل قبلا ثبت شده است',
            'nationcode.required'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.min'=>  "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.max'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.regex'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.unique'=> "* این کدملی قبلا ثبت شده است .",
            'gender.required'=>' تعیین جنسیت الزامی است.',
            'introduced.exists'=>'* کد معرف صحیح نمی باشد.',
            'password.required' => ' رمز عبور الزامی است.',
            'password.max' => ' حداکثر طول رمزعبور 255 کارکتر',
            'password.min' => ' حداقل طول رمزعبور 6 کارکتر',
            'password.confirmed' => ' تکرار رمز عبور منطبق نمی باشد ',
        ]);

        if($request->gender==genderType::famale || $request->gender==genderType::male|| $request->gender==genderType::other)
        {
            $verify_code = rand(1000,9999);
            $verify_expire = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');

             $user = new User;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->mobile = $request->mobile;
            $user->verify_code = $verify_code;
            $user->verify_expire = $verify_expire;
            $user->gender = $request->gender;
            $user->code  = $this->code->create($user);
            $user->introduced = $request->introduced;
            $user->password =Hash::make($request->password);
            $user->save();

           $presenter = Number::with('user')->where("mobile",$user->mobile)->first();
           if($presenter != null)
           {
                //افزودن 3 امتیاز به کاربر
                $pointService = new PointService();
                $pointService->update($presenter->user,3);

               //ارسال sms
                $msg = " شماره تماس".$user->mobile." که توسط شما به سامانه لاوین معرفی گردید در این سامانه عضو شد و 3 امتیاز به شما اضافه گردید.\nکلینیک لاوین رشت";
                $sms = new SMS;
                $sms->send(array($presenter->user->mobile),$msg);
           }


            Auth::login($user);
            return  response()->json(['message'=>'ثبت نام با موفقیت انجام شد.'],200);
        }


    }
}
