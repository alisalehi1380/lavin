<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Image;
use App\Services\ImageService;
use App\Enums\Status;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;


class GalleryController extends Controller
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
        $this->authorize('gallery.index');

        $galleries = Gallery::with('images')->orderBy('created_at','desc')->get();
        return view('admin.gallery.index',compact('galleries'));
    }

    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('gallery.store');

        $request->validate([
            'name'=>'required|max:255',
            'image' =>'required|image|mimes:jpeg,png,jpg,webp|max:200',
        ],
        [
            'name.required'=>' عنوان عکس الزامی است.',
            'name.max'=>'حدکثر طول مجاز عنوان گالری 255 کارکتر است.',
            'image.required'=>' لطفا تصویر را ضمیمه کنید.',
            "image.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
            "image.image"=>" تنها تصویر قابل آپلود است.",
            "image.max"=>" حداکثر حجم مجاز برای آپلود تصویر 200 کیلوبایت است.",

        ]);


        $path = $this->imageService->path();
        $image = $this->imageService->upload($request->image,[
            'original' => [
                'w'=>getimagesize($request->image)[0],
                'h'=>getimagesize($request->image)[1],
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
                'w'=>150,
                'h'=>54,
            ],
        ],$path);

        $status = Status::Deactive;
        if($request->status == 'on')
        {
            $status = Status::Active;
        }

        $gallery = Gallery::create([
            'name'=>$request->name,
            'slug' => SlugService::createSlug(Gallery::class, 'slug', $request->name),
            'status'=>$status
        ]);

        Image::create([
            'imageable_id'=> $gallery->id,
            'imageable_type'=> get_class($gallery),
            'title'=>$request->name,
            'alt'=>$request->name,
            'name'=>$image,
            'path'=>$path,
        ]);

        toast('گالری جدید ثبت شد.','success')->position('bottom-end');        

        return back();
    }

    public function update(Gallery $gallery,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('gallery.update');
 
        $request->validate([
            'name'=>'required|max:255',
        ],
        [
            'name.required'=>' عنوان عکس الزامی است.',
        ]);

        $status = Status::Deactive;
        if($request->status == 'on')
        {
            $status = Status::Active;
        }

        $gallery->name = $request->name;
        $gallery->status = $status;
        $gallery->save();
         
        toast('بروزرسانی انجام شد.','success')->position('bottom-end');        

        return back();
    }
 

    public function destroy(Gallery $gallery)
    { 
       //اجازه دسترسی
       config(['auth.defaults.guard' => 'admin']);
       $this->authorize('gallery.destroy');
        
        $gallery->delete();
        toast('گالری مورد نظر شد.','error')->position('bottom-end'); 
        return back();
    }

}
