<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RecoveryPassAdmimMail;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Admin;
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
        if (Auth::guard('admin')->check())
        {
            return  redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
 
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember')))
        {   
            return redirect()->route('admin.dashboard')->with('status','You are Logged in as admin!');
        }
 
        //keep track of login attempts from the user.

        $this->incrementLoginAttempts($request);
        //Authentication failed

        return redirect()->back()->with('errors', 'مشخصات ورود صحیح نمی باشد.');   
    }
    
    

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function forgotPass()
    {
        return  view('admin.forgotPass');
    }

    public function recoveyPass(Request $request)
    {
        $email = $request->email;

        $admin = Admin::where('email',$email)->where('status',Status::Active)->first();
        if($admin==null)
        {
            alert()->error('خطا','آدرس ایمیل وارد شده در سیستم ثبت نشده است');
            return back();
        }

        $token = Str::random(99);
        $admin->remember_token = $token;
        $admin->token_expire = Carbon::now()->addDay(1);
        $admin->save();

        Mail::to($email)->send(new RecoveryPassAdmimMail($token));

        alert()->success('تبریک','لینک بازیابی به ایمیل شما ارسال شد.');
    
        return back(); 
    }

    public function changePass($token)
    {

        return  view('admin.email.changePass',compact('token')); 
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

           $admin = Admin::where('remember_token',$token)->first();
       
           if($admin==null || $admin->token_expire < Carbon::now())  
           {
                alert()->error('خطا','لینک بازیابی رمز عبور منقضی شده است. لطفا مجددا درخواست نمایید.');
                return back();
           }

           $token = Str::random(99);
           $admin->remember_token = $token;
           $admin->token_expire = Carbon::now()->addDay(1);
           $admin->password =   Hash::make($request->password);
           $admin->save();

           alert()->success('تبریک','رمز عبور شما با موفقیت تغییر یافت.');
           return back();

    }


}
