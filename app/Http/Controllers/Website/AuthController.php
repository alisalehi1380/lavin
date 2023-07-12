<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Mail\RecoveryPassAdmimMail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Enums\Status;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Redirect;

class AuthController extends Controller
{
    use ThrottlesLogins;

    public $maxAttempts = 5;
    public $decayMinutes = 3;

    public function username(){
        return 'email';
    }

    public function loginPage()
    {
        if (Auth::check())
        {
            return  redirect()->route('website.home');
        }

        return view('website.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'mobile'=>'required',
            'password'=>'required'
        ],
        [
            'mobile.required'=>'شماره تماس را وارد کنید.',
            'password.required'=>'رمز عبور را وارد کنید.'
        ]);
      
        if(Auth::attempt(['mobile' => $request->mobile, 'password' => $request->password], $request->get('remember')))
        {   
            return  response()->json(['message'=>'ورود با موفقیت انجام شد.'],200);
        }
 
        //keep track of login attempts from the user.

        $this->incrementLoginAttempts($request);
        //Authentication failed

        return  response()->json(['message'=>'مشخصات ورود صحیح نمی باشد.'],401);
 
    }
    

    public function logout()
    {
        Auth::logout();
        return  back();
    }

    public function forgotPass()
    {
        return  view('website.forgotPass');
    }

    public function recoveyPass(Request $request)
    {
        $email = $request->email;

        $user = User::where('email',$email)->where('status',Status::Active)->first();
        if($user==null)
        {
            alert()->error('خطا','آدرس ایمیل وارد شده در سیستم ثبت نشده است');
            return back();
        }

        $token = Str::random(99);
        $user->remember_token = $token;
        $user->token_expire = Carbon::now()->addDay(1);
        $user->save();

        Mail::to($email)->send(new RecoveryPassAdmimMail($token));

        alert()->success('تبریک','لینک بازیابی به ایمیل شما ارسال شد.');
    
        return back(); 
    }

    public function changePass($token)
    {

        return  view('website.email.changePass',compact('token')); 
    }

    public function changePassword(Request $request,$token)
    {
        $request->validate(
        [   
            "password"=>['min:6'],
            "password_confirm"=>['min:6','required_with:password','same:password'],
        ],
        [
            "password.required"=>"رمز عبور الزامی است",
            "password.min"=>"طول رمز عبور باید حداقل 6  کارکتر باشد." ,
            "password_confirm.required"=>"تکرار رمز عبور الزامی است.",
            "password_confirm.min"=>"طول تکرار رمز عبور باید حداقل 6  کارکتر باشد." ,
            "password_confirm.same"=>"تکرار رمز عبور منطبق نمی باشد." ,
        ]);

        $user = User::where('remember_token',$token)->first();
    
        if($user==null || $user->token_expire < Carbon::now())  
        {
            alert()->error('خطا','لینک بازیابی رمز عبور منقضی شده است. لطفا مجددا درخواست نمایید.');
            return back();
        }

        $token = Str::random(99);
        $user->remember_token = $token;
        $user->token_expire = Carbon::now()->addDay(1);
        $user->password =   Hash::make($request->password);
        $user->save();

        alert()->success('تبریک','رمز عبور شما با موفقیت تغییر یافت.');
        return back();

    }


}
