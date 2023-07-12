<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use App\Models\Admin;
use App\Enums\genderType;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use App\Services\CodeService;
use Carbon\Carbon;

class UserController extends Controller
{
  private $code;
  public function __construct()
  {
      $this->code = new CodeService;
  }

  public function index()
  {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('users.index'); 
      $levels = Level::orderBy('point','asc')->get();
      $users = User::with('level')->withTrashed()->filter()->orderBy('created_at','desc')->paginate(10);
      $users = $users->appends(request()->query());
      return view('admin.users.all',compact('users','levels'));
  }


  public function create()
  {
    //اجازه دسترسی
    config(['auth.defaults.guard' => 'admin']);
    $this->authorize('users.create'); 
    $levels = Level::orderBy('point','asc')->get();
    return view('admin.users.create',compact('levels'));
  }

  public function store(Request $request)
  {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('users.create'); 

      $request->validate([
        'firstname'=>'required|max:255',
        'lastname'=>'required|max:255',
        'mobile'=>'required|min:11|max:11|regex:/^[0-9]+$/|unique:users',
        'nationcode'=>'required|min:10|max:10|regex:/^[0-9]+$/|unique:users',
        'gender'=>'required',
        'level'=>'required|exists:levels,id',
        'introduced'=>'nullable|exists:users,code',
        "password"=>['required','max:255','min:6','confirmed','required_with:password_confirmation|same:password_confirmation'],
      ]
      ,
      [
        'firstname.required'=>' * الزامی است.',
        'firstname.max' => '  *حداکثر 255 کارکتر ',
        'lastname.required'=>' * الزامی است.',
        'lastname.max' => '  *حداکثر 255 کارکتر ',
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
        $user->nationcode = $request->nationcode;
        $user->verify_code = $verify_code;
        $user->verify_expire = $verify_expire;
        $user->gender = $request->gender;
        $user->code  = $this->code->create($user);
        $user->introduced = $request->introduced;
        $user->password = Hash::make($request->password);
        $user->save();

        toast('کاربر جدید افزوده شد.','success')->position('bottom-end');
      }

      return redirect(route('admin.users.index'));
  }

  public function edit(User $user)
  {
    //اجازه دسترسی
    config(['auth.defaults.guard' => 'admin']);
    $this->authorize('users.edit'); 
    $levels = Level::orderBy('point','asc')->get();
    return view('admin.users.edit',compact('levels','user'));
  }

  public function update(User $user,Request $request)
  {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('users.edit'); 

      $request->validate([
        'firstname'=>'required|max:255',
        'lastname'=>'required|max:255',
        'mobile'=>'required|min:11|max:11|regex:/^[0-9]+$/|unique:users,mobile,'.$user->id,
        'nationcode'=>'required|min:10|max:10|regex:/^[0-9]+$/|unique:users,nationcode,'.$user->id,
        'gender'=>'required',
        'level'=>'required|exists:levels,id',
        'introduced'=>'nullable|exists:users,code',
        "password"=>['nullable','max:255','min:6','confirmed','required_with:password_confirmation|same:password_confirmation'],
      ]
      ,
      [
        'firstname.required'=>' * الزامی است.',
        'firstname.max' => '  *حداکثر 255 کارکتر ',
        'lastname.required'=>' * الزامی است.',
        'lastname.max' => '  *حداکثر 255 کارکتر ',
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
        'introduced.exists'=>'* کد معرف صحیح نمی باشد.',
        'gender.required'=>' تعیین جنسیت الزامی است.',
        'password.required' => ' رمز عبور الزامی است.',
        'password.max' => ' حداکثر طول رمزعبور 255 کارکتر',
        'password.min' => ' حداقل طول رمزعبور 6 کارکتر',
        'password.confirmed' => ' تکرار رمز عبور منطبق نمی باشد ',
      ]);

      if($request->gender==genderType::famale || $request->gender==genderType::male|| $request->gender==genderType::other)
      {
         $user->firstname = $request->firstname;
         $user->lastname = $request->lastname;
         $user->nationcode = $request->nationcode;

        if($user->mobile != $request->mobile)
        {
          $user->verify_code = rand(1000,9999);
          $user->verify_expire = Carbon::now()->addMinute(5)->format('Y-m-d H:i:s');
          $user->verified =false;
          $user->mobile = $request->mobile;
        }

        $user->gender = $request->gender;

        if($user->introduced != $request->introduced)
        {
          $user->introduced  = $this->code->create($user);
          $user->introduced = $request->introduced;
        }

        if(isset($request->password))
        {
          $user->password =Hash::make($request->password);
        }

        $user->save();

        toast('بروزرسانی انجام شد.','success')->position('bottom-end');
      }

      return redirect(route('admin.users.index'));
  }

  public function destroy(User $user)
  {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('users.destroy'); 

      $user->delete();
      toast(' کاربر مورد نظر حذف شد.','error')->position('bottom-end');
      return back();
  }

  public function recycle($id)
  {
      //اجازه دسترسی
      config(['auth.defaults.guard' => 'admin']);
      $this->authorize('users.destroy'); 

      $service = User::withTrashed()->find($id);
      $service->restore();
      toast('کاربر مورد نظر بازیابی  شد.','error')->position('bottom-end');
      return back();
  }


  public function fetch()
  {
    $keyword = request('term');
    if(isset($keyword) && strlen($keyword)>2)
    {
      $users = User::where('firstname','like','%'.$keyword.'%')->orWhere('lastname','like','%'.$keyword.'%')->orWhere('mobile','like','%'.$keyword.'%')
      ->orWhere('nationcode','like','%'.$keyword.'%')->get();
    }
    else
    {
      return null;
    }

    return new UserCollection($users);
  }
}
