<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Support\Facades\File;

class ImageGalleryController extends Controller
{
    private $imageService;

    public function __construct()
    {
        $this->imageService = new ImageService();
    }


    public function index(Gallery $gallery)
    {
       //اجازه دسترسی
       config(['auth.defaults.guard' => 'admin']);
       $this->authorize('gallery.images.index');

        $images = Image::where('imageable_id',$gallery->id)
        ->where('imageable_type',get_class($gallery))->orderBy('created_at','desc')->get();
 
        return view('admin.gallery.images',compact('gallery','images'));
    }

    public function store(Gallery $gallery,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('gallery.images.store');

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

    public function destroy(Gallery $gallery,Image $image)
    { 
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('gallery.images.destroy');


        $count = Image::where('imageable_id',$gallery->id)->where('imageable_type',get_class($gallery))->count();
        if($count==1)
        {
            alert()->error('هر گالری می بایست حداقل یک عکس داشته باشد.');
            return back();
        }

        $image->destroyImage();
        toast('تصویر مورد نظر شد.','error')->position('bottom-end'); 
        return back();
    }
}
