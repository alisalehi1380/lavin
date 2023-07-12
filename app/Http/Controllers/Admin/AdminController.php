<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use App\Models\Image;
use Illuminate\Support\Facades\Hash;
use App\Services\ImageService;
use Illuminate\Support\Facades\Gate;
use Auth;

class AdminController extends Controller
{
    private $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }

 
    public function index()
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.index'); 
 
       $admins = Admin::with('roles','image')->withTrashed()->filter()->orderBy('created_at','desc')->paginate(10);  
       $roles = Role::orderBy('name','asc')->get();

       return  view('admin.admins.all',compact('admins','roles'));
 
    }
 
    public function create()
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.create'); 
 
       $roles = Role::orderBy('name','asc')->get();
       return  view('admin.admins.create',compact('roles'));
    }

   
    public function store(Request $request)
    {
        
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.create'); 

        $request->validate(
        [   
            'image' =>'image|mimes:jpeg,png,jpg,webp|max:2048',
            "fullname"=>['required','max:255'],
            "mobile"=>['required','max:11','min:11'],
            "nationalcode"=>['required','max:10','min:10'],
            "email"=>['required','email','max:255'],
            "password"=>['required','max:255','min:6','required_with:password_confirmation|same:password_confirmation'],
            "gender"=>['required','integer'],
            "status"=>['required','integer'],
            "roles"=>['required'],
        ],
        [
            "fullname.required"=>"* الزامی است.",
            "fullname.max"=>"* حداکثر 255 کارکتر",
            "mobile.required"=>"* الزامی است.",
            "mobile.max"=>"0911xxxxxxx",
            "mobile.min"=>"0911xxxxxxx",
            "email.required"=>"* الزامی است.",
            "email.email"=>"ایمیل وارد شده معتبر نیست.",
            "email.max"=>"* حداکثر 255 کارکتر ",
            "nationalcode.required"=>"* الزامی است.",
            "nationalcode.min"=>"* کدملی 10 رقمی است.",
            "nationalcode.max"=>"* کدملی 10 رقمی است.",
            "password.required"=>"* الزامی است",
            "password.max"=>"* حداکثر 255 کارکتر ",
            "password.min"=>"* حداقل 255 کارکتر ",
            "password.required_with"=>"تکرار رمز عبور منطبق نیست.",
            "image.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "image.image"=>"تنها تصویر قابل آپلود است.",
            "image.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
            "roles.required"=> "انتخاب حداقل یک نقش الزامی است."
        ]);

 
        $admin = Admin::create([
            "fullname"=> $request->fullname,
            "mobile"=> $request->mobile,
            "nationalcode"=> $request->nationalcode,
            "email"=> $request->email,
            "gender"=> $request->gender,
            "status"=> $request->status,
            'password' => Hash::make($request->password),
        ]);

        $admin->roles()->sync($request->roles);

        if(isset($request->image))
        {
            $path = $this->imageService->path();
            $image = $this->imageService->upload($request->image,[
                'original' => [
                    'w'=>getimagesize($request->image)[0],
                    'h'=>getimagesize($request->image)[1],
                ],
                'large' => [
                    'w'=>1023,
                    'h'=>507,
                ],
                'medium' => [
                    'w'=>267,
                    'h'=>273,
                ],
                'thumbnail' => [
                    'w'=>150,
                    'h'=>54,
                ],
            ],$path);
        
            
            $admin->image()->create([
                'title' => $request->name,
                'alt' => $request->name,
                'name' => $image,
                'path'=>$path
            ]);

        }

        toast('کاربر جدید افزوده شد.','success')->position('bottom-end');  
        
        return redirect(route('admin.admins.index'));
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit(Admin $admin)
    {
        
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.edit'); 


        $admin = Admin::with('roles','image')->find($admin->id);
        $roles = Role::orderBy('name','asc')->get();
 
         return view('admin.admins.edit',compact('admin','roles'));
    }

 
    public function update(Request $request,Admin $admin)
    {
        
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.edit'); 
        
        $request->validate(
            [   
                'image' =>'image|mimes:jpeg,png,jpg,webp|max:2048',
                "fullname"=>['required','max:255'],
                "mobile"=>['required','max:11','min:11'],
                "nationalcode"=>['required','max:10','min:10'],
                "email"=>['required','email','max:255'],
                "password"=>['nullable','max:255','min:6','required_with:password_confirmation|same:password_confirmation'],
                "gender"=>['required','integer'],
                "status"=>['required','integer'],
                "roles"=>['required'],
            ],
            [
                "fullname.required"=>"* الزامی است.",
                "fullname.max"=>"* حداکثر 255 کارکتر",
                "mobile.required"=>"* الزامی است.",
                "mobile.max"=>"091xxxxxxxx",
                "mobile.min"=>"091xxxxxxxx",
                "email.required"=>"* الزامی است.",
                "email.email"=>"ایمیل وارد شده معتبر نیست.",
                "email.max"=>"* حداکثر 255 کارکتر ",
                "nationalcode.required"=>"* الزامی است.",
                "nationalcode.min"=>"* کدملی 10 رقمی است.",
                "nationalcode.max"=>"* کدملی 10 رقمی است.",
                "password.max"=>"* حداکثر 255 کارکتر ",
                "password.min"=>"* حداقل 255 کارکتر ",
                "password.required_with"=>"تکرار رمز عبور منطبق نیست.",
                "image.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "image.image"=>"تنها تصویر قابل آپلود است.",
                "image.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
                "roles.required"=> "انتخاب حداقل یک نقش الزامی است."
            ]);
    
             
            $admin->fullname = $request->fullname;
            $admin->mobile = $request->mobile;
            $admin->nationalcode = $request->nationalcode;
            $admin->email = $request->email;
            $admin->gender = $request->gender;
            $admin->status = $request->status;

            if(isset($request->password))
            {
                $admin->password =  Hash::make($request->password);
            }

            $admin->save();

            $admin->roles()->sync($request->roles);
            
            if(isset($request->image))
            {
                $image = Image::where('imageable_id',$admin->id)->where('imageable_type',get_class($admin))->first();
               
                if($image!=null)
                {
                    $image->destroyImage();
                }

                $path = $this->imageService->path();
                $image = $this->imageService->upload($request->image,[
                    'original' => [
                        'w'=>getimagesize($request->image)[0],
                        'h'=>getimagesize($request->image)[1],
                    ],
                    'large' => [
                        'w'=>1023,
                        'h'=>507,
                    ],
                    'medium' => [
                        'w'=>267,
                        'h'=>273,
                    ],
                    'thumbnail' => [
                        'w'=>150,
                        'h'=>54,
                    ],
                ],$path);
            
                
                $admin->image()->create([
                    'title' => $request->name,
                    'alt' => $request->name,
                    'name' => $image,
                    'path'=>$path
                ]);
            }

        toast('بروزرسانی انجام شد.','success')->position('bottom-end');  

        return redirect(route('admin.admins.index'));
    }

     
    public function destroy(Admin $admin)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.destroy'); 

        $admin->delete();

        toast('ادمین مورد نظر حذف شد.','success')->position('bottom-end');  

        return back();
    }

    public function recycle($id)
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('admins.destroy'); 
         
        $admin = Admin::withTrashed()->find($id);
        $admin->restore();
        toast('ادمین مورد نظر بازیابی شد.','error')->position('bottom-end');
        return back();
    }

 
}
