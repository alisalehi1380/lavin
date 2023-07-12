<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Enums\Status;
use App\Models\ServiceCategory;
use App\Services\ImageService;
use Validator;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceController extends Controller
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
        $this->authorize('services.index');

        $allservices  = Service::with('parent_cat','child_cat')->withTrashed()->orderBy('name','asc')->paginate(10);
        return view('admin.services.all',compact('allservices'));
    }

    
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.create');

        $parents = ServiceCategory::where('parent_id',0)->where('status',Status::Active)->orderBy('name','desc')->get();
        return view('admin.services.create',compact('parents'));
    }

   
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.create');

        $displayed =  Service::where('displayed',true)->count();
        if($displayed<5)
        {
            Validator::extend('displayed_validator',function(){return true;});
        }
        else
        {
            Validator::extend('displayed_validator',function(){return false;});
        }

        $request->validate(
            [
                'name' => ['required','max:255','unique:services'],
                'parent' => ['required','integer'],
                'child' => ['required','integer'],
                'desc' => ['required','max:63000'],
                'thumbnail' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'displayed'=>'displayed_validator'
            ],
            [
                'name.required' => '* الزامی است.',
                'name.max' => '* حداکثر 255 کارکتر می باشد.',
                'name.unique' => '* تکراری است.',
                'parent.required' => '* الزامی است.',
                'child.required' => '* الزامی است.',
                'desc.required' => '* الزامی است.',
                'desc.max' => '* حداکثر 255 کارکتر می باشد.',
                'thumbnail.required' => '* تصویر شاخص الزامی است.',
                "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
                "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
                'displayed.displayed_validator'=>"بیشتر از 5 سرویس در صفحه اصلی نمایش داده نمی شود."
            ]
        );
 
    
        if($request->status==Status::Active || $request->status==Status::Deactive)
        {   
            $displayed = isset($request->displayed)?true:false;
 
            $service = Service::create([
                'name'=> $request->name,
                'slug' => SlugService::createSlug(Service::class, 'slug', $request->name),
                'parent'=> $request->parent,
                'child'=> $request->child,
                'status'=> $request->status,
                'displayed'=>$displayed,
                'desc'=> $request->desc,
            ]);
    
            $path = $this->imageService->path();
            $thumbnail = $this->imageService->upload($request->thumbnail,[
                'original' => [
                    'w'=>getimagesize($request->thumbnail)[0],
                    'h'=>getimagesize($request->thumbnail)[1],
                ],
                'large' => [
                    'w'=>1280,
                    'h'=>458,
                ],
                'medium' => [
                    'w'=>267,
                    'h'=>273,
                ],
                'thumbnail' => [
                    'w'=>42,
                    'h'=>29,
                ],
            ],$path);
    
            $service->thumbnail()->create([
                'title' => $request->name,
                'alt' => $request->name,
                'name' => $thumbnail,
                'path'=>$path
            ]);
    
            toast('سرویس جدید ثبت شد.','success')->position('bottom-end');        
        }
     
        return redirect(route('admin.services.index'));
    }

    
    public function show($id)
    {
        //
    }
 
    public function edit(Service $service)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.edit');

        $parents = ServiceCategory::where('parent_id',0)->where('status',Status::Active)->orderBy('name','desc')->get();
        $childs = ServiceCategory::where('parent_id',$service->parent)->where('status',Status::Active)->orderBy('name','desc')->get();

        return view('admin.services.edit',compact('service','parents','childs'));
    }

  
    public function update(Request $request,Service $service)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.edit');

        $displayed =  Service::where('displayed',true)->where('id','<>',$service->id)->count();
        if($displayed<5)
        {
            Validator::extend('displayed_validator',function(){return true;});
        }
        else
        {
            Validator::extend('displayed_validator',function(){return false;});
        }
// return $request;
        
        $request->validate(
            [
                'name' => ['required','max:255','unique:services,id,'.$service->id],
                'parent' => ['required'],
                'child' => ['required'],
                'desc' => ['required','max:63000'],
                'thumbnail' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'displayed'=>'displayed_validator'
            ],
            [
                'name.required' => '* الزامی است.',
                'name.max' => '* حداکثر 255 کارکتر می باشد.',
                'name.unique' => '* تکراری است.',
                'parent.required' => '* الزامی است.',
                'child.required' => '* الزامی است.',
                'desc.required' => '* الزامی است.',
                'desc.max' => '* حداکثر 255 کارکتر می باشد.',
                "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
                "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
                'displayed.displayed_validator'=>"بیشتر از 5 سرویس در صفحه اصلی نمایش داده نمی شود."
            ]
        );

 
        if($request->status==Status::Active || $request->status==Status::Deactive)
        {   
            $displayed = isset($request->displayed)?true:false;
 
            $service->update([
                'name'=> $request->name,
                'slug' => SlugService::createSlug(Service::class, 'slug', $request->name),
                'parent'=> $request->parent,
                'child'=> $request->child,
                'status'=> $request->status,
                'displayed'=>$displayed,
                'desc'=> $request->desc,
            ]);
    
            if(isset($request->thumbnail))
            {
                $service->thumbnail->destroyImage();
                $path = $this->imageService->path();
                $thumbnail = $this->imageService->upload($request->thumbnail,[
                    'original' => [
                        'w'=>getimagesize($request->thumbnail)[0],
                        'h'=>getimagesize($request->thumbnail)[1],
                    ],
                    'large' => [
                        'w'=>1280,
                        'h'=>458,
                    ],
                    'medium' => [
                        'w'=>267,
                        'h'=>273,
                    ],
                    'thumbnail' => [
                        'w'=>42,
                        'h'=>29,
                    ],
                ],$path);
        
                $service->thumbnail()->create([
                    'title' => $request->name,
                    'alt' => $request->name,
                    'name' => $thumbnail,
                    'path'=>$path
                ]);
            }

            toast('بروزرسانی انجام شد.','success')->position('bottom-end');        
        }
     
        return redirect(route('admin.services.index'));
    }

    
    public function destroy(Service $service)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.delete');

        $service->delete();
        toast(' سرویس مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    }

    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.delete');

           
        $service = Service::withTrashed()->find($id);
        $service->restore();
        toast('سرویس مورد نظر بازیابی  شد.','error')->position('bottom-end');        
        return back();
    }

    public function fetch_details()
    {
        $service_id = request('service_id');
        $details = ServiceDetail::where('service_id',$service_id)->where('status',Status::Active)->get();
        return response()->json(['details'=>$details],200);
    }
}
