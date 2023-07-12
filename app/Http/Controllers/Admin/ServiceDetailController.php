<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceDetailVideo;
use App\Models\Luck;
use App\Models\Image;
use App\Models\Admin;
use App\Enums\Status;
use Illuminate\Http\Request;
use  Validator;
use App\Services\FunctionService;
use App\Services\ImageService;
use App\Services\VideoService;
use RealRashid\SweetAlert\Facades\Alert;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ServiceDetailController extends Controller
{
    private $imageService;
    private $videoService;
    private $fuctionService;

    public function __construct()
    {
        $this->imageService = new ImageService();
        $this->videoService = new VideoService();
        $this->fuctionService = new FunctionService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.index');

       $details =  ServiceDetail::orderBy('name','asc')->withTrashed()->get();
       return view('admin.details.all',compact('details'));
    }
 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.create');

        $allservices = Service::orderBy('name','asc')->get();
        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->get();
        
        return view('admin.details.create',compact('allservices','doctors'));
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.create');

        $dt = ServiceDetail::where('service_id',$request->service)->where('name',$request->name)->first();
        if($dt==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate([
            'service'=>'required|exists:services,id',
            'name'=>'required|max:255|unique_validator',
            'price'=>'required|integer',
            'point'=>'required|integer',
            'porsant'=>'required|integer',
            'breif'=>'nullable|max:255',
            'desc'=>'nullable|max:63000',
            'status'=>'required|integer',
            'doctors'=>'required|array',

        ],[
            'service.required' => '* الزامی',
            'name.required' => '* الزامی',
            'name.unique_validator' => '* قبلا ثبت شده است',
            'name.max' => '* حداکثر 255 کارکتر',
            'price.required' => '* الزامی',
            'price.integer' => '* مقدار عددی وارد شود',
            'point.required' => '* الزامی',
            'point.integer' => '* مقدار عددی وارد شود',
            'porsant.required' => '* الزامی',
            'porsant.integer' => '* مقدار عددی وارد شود',
            'breif.max' => '* حداکثر 255 کارکتر',
            'desc.max' => '* حداکثر 63000 کارکتر',
            'doctors.required' => '* الزامی',
        ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $detail = ServiceDetail::create([
                'service_id'=> $request->service,
                'name'=> $request->name,
                'slug' => SlugService::createSlug(ServiceDetail::class, 'slug', $request->name),
                'price'=> $request->price,
                'porsant'=> $request->porsant,
                'point'=> $request->point,
                'breif'=> $request->breif,
                'desc'=> $request->desc,
                'status'=> $request->status,
            ]);

            $detail->doctors()->sync($request->doctors);
        }

        return redirect(route('admin.details.index'));    

    }

 
    public function show($id)
    {
        //
    }

  
    public function edit(ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.edit');

        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->get();
        $detail = ServiceDetail::with('doctors')->find($detail->id);
        $allservices = Service::orderBy('name','asc')->get();
        return view('admin.details.edit',compact('allservices','detail','doctors'));
    }

    
    public function update(Request $request,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.edit');

        $dt = ServiceDetail::where('service_id',$request->service)->where('name',$request->name)->where('id','<>',$detail->id)->first();
        if($dt==null)
        {
            Validator::extend('unique_validator',function(){return true;});
        }
        else
        {
            Validator::extend('unique_validator',function(){return false;});
        }

        $request->validate([
            'service'=>'required|exists:services,id',
            'name'=>'required|max:255|unique_validator',
            'price'=>'required|integer',
            'point'=>'required|integer',
            'porsant'=>'required|integer',
            'status'=>'required|integer',

        ],[
            'name.required' => '* الزامی',
            'name.unique_validator' => '* قبلا ثبت شده است',
            'name.max' => '* حداکثر 255 کارکتر',
            'price.required' => '* الزامی',
            'price.integer' => '* مقدار عددی وارد شود',
            'point.required' => '* الزامی',
            'point.integer' => '* مقدار عددی وارد شود',
            'porsant.required' => '* الزامی',
            'porsant.integer' => '* مقدار عددی وارد شود',
        ]);
    

        $detail->update([
            'name'=> $request->name,
            'service_id'=> $request->service,
            'slug' => SlugService::createSlug(ServiceDetail::class, 'slug', $request->name),
            'price'=> $request->price,
            'porsant'=> $request->porsant,
            'point'=> $request->point,
            'breif'=> $request->breif,
            'desc'=> $request->desc,
            'status'=> $request->status,
        ]);

        $detail->doctors()->sync($request->doctors);

        return redirect(route('admin.details.index'));
    }
 
    public function destroy(Service $service,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.delete');

        $detail->delete();
        toast(' جزئیات مورد نظر حذف شد.','error')->position('bottom-end');
        return back();
    }

    public function recycle(Service $service,$id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.delete');

                
        $service = ServiceDetail::withTrashed()->find($id);
        $service->restore();
        toast('جزئیات مورد نظر بازیابی  شد.','error')->position('bottom-end');
        return back();
    }

    public function showimages(ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.images.show');

                
        $images = Image::where('imageable_type',get_class($detail))->where('imageable_id',$detail->id)->get();
        return view('admin.details.images',compact('images','detail'));
    }

    public function imagestore(Request $request,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.images.store');

        $request->validate(
        [
            'title' => ['required','max:255'],
            'image' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            "title.required" => "* الزامی است.",
            "title.max" => "* حداکثر 255 کارکتر .",
            "image.required" => "* الزامی است.",
            "image.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "image.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
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
                'w'=>337,
                'h'=>337,
            ],
            'thumbnail' => [
                'w'=>52,
                'h'=>52,
            ],
        ],$path);


        Image::create([
           'imageable_id'=> $detail->id,
           'imageable_type'=>  get_class($detail),
           'name'=> $image,
           'alt'=> $request->title,
           'title'=> $request->title,
           'path'=> $path,
        ]);

        toast('.عکس جدید افزوده شد','success')->position('bottom-end');
        return back();
    }

    public function imagedelete(Service $service,ServiceDetail $detail,Image $image)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.images.delete');

        $image->destroyImage();
        toast('تصویر مورد نظر حذف شد.','error')->position('bottom-end');
        return back();
    }

    public function showvideos(ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.videos.show');

        $videos = ServiceDetailVideo::with('poster')->where('detil_id',$detail->id)->orderBy('created_at','desc')->get();
        return view('admin.details.videos.all',compact('videos','detail'));
    }

    public function imagecreate(ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.videos.create');

        return view('admin.details.videos.create',compact('detail'));
    }


    public function videostore(Request $request,Service $service,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.videos.create');

        $request->validate(
        [
            'title' => ['required','max:255'],
            'link' =>['required','max:63000'],
            'poster' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            "title.required" => "* الزامی است.",
            "title.max" => "* حداکثر 255 کارکتر .",
            "link.required" => "* الزامی است.",
            "link.max" => "* حداکثر 63000 کارکتر .",
            "poster.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "poster.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
        ]);

        $video = ServiceDetailVideo::create([
           'detil_id'=> $detail->id,
           'title'=> $request->title,
           'link'=> $request->link,
        ]);

        if(isset($request->poster))
        {
            $path = $this->imageService->path();
            $poster = $this->imageService->upload($request->poster,[
                'original' => [
                    'w'=>getimagesize($request->poster)[0],
                    'h'=>getimagesize($request->poster)[1],
                ],
                'large' => [
                    'w'=>1280,
                    'h'=>458,
                ],
                'medium' => [
                    'w'=>494,
                    'h'=>618,
                ],
                'thumbnail' => [
                    'w'=>150,
                    'h'=>54,
                ],
            ],$path);

            Image::create([
                'imageable_id'=> $video->id,
                'imageable_type'=>  get_class($video),
                'name'=> $poster,
                'alt'=> $request->title,
                'title'=> $request->title,
                'path'=> $path,
             ]);

        }

        toast('ویدئو جدید ثبت شد.','success')->position('bottom-end');

         return redirect(route('admin.details.videos.show',$detail));
    }



    public function videoupload(Request $request,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.videos.create');

        $request->validate(
            [
                'video' =>'required|mimes:mp4,mov,ogg | max:102400',
            ],
            [
                "video.required" => "* الزامی است.",
                "video.max"=>"حداکثر حجم مجاز برای تصویر شما 100 مگابایت است.",
                "video.image"=>"* فرمت‌های مجاز mp4,mov,ogg",
            ]);

            $path = $this->videoService->path();
            $video = $this->videoService->upload($request->video,$path);
            
            $url =  url('/').'/'.$video;

            return response()->json([
                'url'=>$url
            ],200);
    }

    public function videodelete(Service $service,ServiceDetail $detail,ServiceDetailVideo $video)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.videos.delete');

        $video->destroyVideo();
        toast('ویدئو مورد نظر حذف شد.','error')->position('bottom-end');
        return back();
    }

    public function luckcreate(ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.luck.create');

        $luck = Luck::where('lucktable_id',$detail->id)->where('lucktable_type',get_class($detail))->first();

        if($luck!=null)
        {
            alert()->error('این سرویس قبلا به گردونه قرعه کشی اضافه شده است.');
            return back();
        }

        return view('admin.details.luck',compact('detail'));
    }

    public function luckstore(Request $request,ServiceDetail $detail)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.luck.create');

        $pr=0;
        if(isset($request->probability))
        {
            $pr = $request->probability;
        }

        $probability = luck::sum('probability')+$pr;

        if($probability>100)
        {
            Validator::extend('percent_validator',function(){return false;});
        }
        else
        {
            Validator::extend('percent_validator',function(){return true;});
        }

        $request->validate(
        [
            "probability"=>['required','regex:/^[0-9]+$/','digits_between:0,100','percent_validator'],
            "discount"=>['required','regex:/^[0-9]+$/','digits_between:0,100']
        ],
        [
            "probability.required"=>"* احتمال برد الزامی است..",
            "probability.regex"=>"* احتمال برد باید عددی بین 0 تا صد باشد.",
            "probability.digits_between"=>"* احتمال برد باید بین 0 تا صد باشد.",
            "probability.percent_validator"=>"* مجموع احتمالات نبایداز 100% بیشتر باشد.",
            "discount.required"=>"* درصد تخفیف الزامی است.",
            "discount.regex"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
            "discount.digits_between"=>"* احتمال تخفیف باید عددی بین 0 تا صد باشد.",
        ]);

        Luck::create([
            'lucktable_id' => $detail->id,
            'lucktable_type' => get_class($detail),
            'probability' => $request->probability,
            'discount' => $request->discount,
        ]);

        return redirect(route('admin.luck.index'));
    }

}
