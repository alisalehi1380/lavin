<?php

namespace App\Http\Controllers\Website\CRM;

use App\Models\Province;
use App\Models\UserAddress;
use App\Models\UserBank;
use App\Enums\Status;
use App\Enums\genderType;
use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\Models\Job;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Validator;
use \Morilog\Jalali\Jalalian;
use App\Services\FunctionService;
use App\Services\PointService;

class ProfileController extends Controller
{
    private $fuctionService;

    public function __construct()
    {
        $this->fuctionService = new FunctionService();
    }

     public function index()
     {
         $user = Auth::user();
         $provinces = Province::where('status',Status::Active)->orderBy('name','asc')->get();
         $jobs = Job::where('status',Status::Active)->orderBy('title','asc')->get();
         $address = UserAddress::where('user_id',Auth::id())->first();
         $bank = UserBank::where('user_id',Auth::id())->first();
         $info = UserInfo::where('user_id',Auth::id())->first();

         return view('crm.profile.index',compact('user','provinces','address','bank','jobs','info'));
     }

     public function updatepro(Request $request)
     {
        $request->validate([
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'nationcode'=>'required|max:10,min:10,|regex:/^[0-9]+$/',
            'mobile'=>'required|max:11,min:11,|regex:/^[0-9]+$/',
        ]
        ,
        [
            'firstname.required'=>'* نام الزامی است.',
            'firstname.max'=>'* نام حداکثر 255 کارکتر',
            'lastname.required'=>'* نام خانوادگی الزامی است.',
            'lastname.max'=>'* نام خانوادگی حداکثر 255 کارکتر',
            'mobile.required'=>'* موبایل الزامی است.',
            'mobile.max'=>'* 09********* فرمت درست موبایل',
            'mobile.min'=>'* 09*********فرمت درست موبایل ',
            'nationcode.required'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.min'=>  "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.max'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.regex'=> "* کد ملی 10 رقمی را وارد کنید.",
            'nationcode.unique'=> "* کد ملی 10 رقمی را وارد کنید"
        ]);

         $user =  Auth::user();
         $user->firstname = $request->firstname;
         $user->lastname = $request->lastname;

         if($user->mobile != $request->mobile)
         {
           $user->verify_code = rand(1000,9999);
           $user->verify_expire = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
           $user->verified =false;
           $user->mobile = $request->mobile;
         }

         if($request->gender==genderType::famale || $request->gender==genderType::male || $request->gender==genderType::other)
         {
            $user->gender = $request->gender;
         }


         $user->save();

         toast('بروزرسانی انجام شد.','success')->position('bottom-end');

         return back();

     }

     public function updatepass(Request $request)
     {
          $request->validate(
          [
            "password"=>['required','max:255','min:6','confirmed','required_with:password_confirmation|same:password_confirmation'],
          ]
          ,
          [
            'password.required' => '* کلمه عبور است.',
            'password.max' => 'حداکثر کلمه 255 کارکتر',
            'password.min' => ' حداقل کلمه 6 کارکتر',
            'password.confirmed' => ' تکرار رمز عبور منطبق نمی باشد ',
          ]);

         $user = Auth::user();
         $user->password = Hash::make($request->password);
         $user->save();

         toast('رمز عبور تغییر یافت.','success')->position('bottom-end');

         return back();
     }

     public function updateaddress(Request $request)
     {
         $request->validate([
            'province_id'=>'required|exists:provinces,id',
            'city_id'=>'required|exists:cities,id',
            'part_id'=>'nullable|exists:city_parts,id',
            'address'=>'required|max:255',
            'postalcode'=>'required|max:10|min:10|regex:/^[0-9]+$/',
        ]
        ,
        [
            'province_id.required'=>'* انتخاب استان الزامی است.',
            'city_id.required'=>'* انتخاب شهر است.',
            'address.required'=>'* آدرس الزامی است.',
            'address.max'=>'* حداکثر طول آدرس 255 کارکتر',
            'postalcode.required'=>'* کدپستی الزامی است.',
            'postalcode.max'=>'* کدپستی 10 رقمی است.',
            'postalcode.min'=>'* کدپستی 10 رقمی است.',
            'postalcode.regex'=>'* کدپستی معتبر نیست.'
        ]);

        $address = UserAddress::where('user_id',Auth::id())->first();
        if($address == null)
        {
            $address =  new UserAddress;
            $address->user_id = Auth::id();
            $address->province_id = $request->province_id;
            $address->city_id = $request->city_id;
            $address->part_id = $request->part_id;
            $address->postalcode = $request->postalcode;
            $address->address = $request->address;
            $address->save();

            //افزودن 3 امتیاز به کاربر
            $pointService = new PointService();
            $pointService->update(Auth::user(),3);
        }
        else
        {
            $address->province_id = $request->province_id;
            $address->city_id = $request->city_id;
            $address->part_id = $request->part_id;
            $address->postalcode = $request->postalcode;
            $address->address = $request->address;
            $address->save();
        }

        toast('آدرس شما ثبت شد.','success')->position('bottom-end');
        return back();
     }

     public function updatebank(Request $request)
     {
         $request->validate([

          'name'=>'required|max:255',
          'cart'=>'required|min:16|max:16|regex:/^[0-9]+$/',
          'account'=>'nullable|max:255|regex:/^[0-9]+$/',
          'shaba'=>'nullable|min:26|max:26|regex:/^[A-Z0-9]+$/',
        ]
        ,
        [
            'name.required'=>'* نام بانک است.',
            'name.max'=>'* حداکثر نام بانک 255 کارکتر',
            'cart.required'=>'* شماره کارت است.',
            'cart.min'=>'* شماره کارت 16 رقمی است.',
            'cart.max'=>'* شماره کارت 16 رقمی است.',
            'cart.regex'=>'* شماره کارت غیرمجاز است',
            'account.max'=>'* حداکثر شماره کارت 50 کارکتر.',
            'account.regex'=>'* شماره کارت غیرمجاز است',
            'shaba.min'=>'* شماره شبا 26 رقمی است.',
            'shaba.max'=>'* شماره شبا 26 رقمی است.',
            'shaba.regex'=>'* شماره کارت غیرمجاز است.'

        ]);

        $bank = UserBank::where('user_id',Auth::id())->first();
        if($bank==null)
        {
            $bank = new UserBank;
            $bank->user_id = Auth::id();
            $bank->name = $request->name;
            $bank->cart = $request->cart;
            $bank->account = $request->account;
            $bank->shaba = $request->shaba;
            $bank->save();

             //افزودن 3 امتیاز به کاربر
            $pointService = new PointService();
            $pointService->update(Auth::user(),3);
        }
        else
        {
            $bank->name = $request->name;
            $bank->cart = $request->cart;
            $bank->account = $request->account;
            $bank->shaba = $request->shaba;
            $bank->save();
        }


        toast('مشخصات بانکی شما ثبت شد.','success')->position('bottom-end');
        return back();
     }

     public function updateinfo(Request $request)
     {

        if(isset($request->maried))
        {
            $maried= true;
        }
        else
        {
            $maried= false;
        }

        if($maried && !isset($request->marriageDate))
        {
            Validator::extend('maried_validator',function(){return false;});
        }
        else
        {
            Validator::extend('maried_validator',function(){return true;});
        }


         $request->validate([
          'job_id'=>'required|exists:jobs,id',
          'email'=>'required|max:255|email',
          'birthDate'=>'required',
          'marriageDate'=>'maried_validator',
        ]
        ,
        [
            'job_id.required'=>'* دسته شغلی الزامی است.',
            'email.required'=>'* آدرس ایمیل است.',
            'email.max'=>'* حداکثر طول آدرس ایمیل 255 کارکتر',
            'email.email'=>'* آدرس ایمیل معتبر نیست.',
            'birthDate.required'=>'* الزامی است.',
            'marriageDate.maried_validator'=>'* تاریخ ازدواج الزامی است.',

        ]);

        $birthDate =  $this->fuctionService->faToEn($request->birthDate);
        $birthDate = Jalalian::fromFormat('Y/m/d', $birthDate)->toCarbon("Y-m-d");

        $marriageDate =null;
        if($maried && isset($request->marriageDate))
        {
            $marriageDate =  $this->fuctionService->faToEn($request->marriageDate);
            $marriageDate = Jalalian::fromFormat('Y/m/d', $marriageDate)->toCarbon("Y-m-d");
        }


        $info = UserInfo::where('user_id',Auth::id())->first();

        if($info==null)
        {
            $info = new UserInfo;
            $info->user_id = Auth::id();
            $info->job_id  = $request->job_id;
            $info->email = $request->email;
            $info->birthDate = $birthDate;
            $info->married = $maried;
            $info->marriageDate = $marriageDate;
            $info->save();

             //افزودن 3 امتیاز به کاربر
            $pointService = new PointService();
            $pointService->update(Auth::user(),3);
        }
        else
        {
            $info->job_id  = $request->job_id;
            $info->email = $request->email;
            $info->birthDate = $birthDate;
            $info->married = $maried;
            $info->marriageDate = $marriageDate;
            $info->save();
        }

        toast('سایر مشخصات شما ثبت شد','success')->position('bottom-end');
        return back();
     }
}
