<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Image;
use App\Enums\Status;
use App\Services\FunctionService;
use App\Services\ImageService;
use App\Services\VideoService;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PortfolioController extends Controller
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
 
    public function index()
    {
         //اجازه دسترسی
         config(['auth.defaults.guard' => 'admin']);
         $this->authorize('portfolios.index');
         
       $portfolios = Portfolio::with('before_img','after_img','poster_img')->orderBy('created_at','desc')->get();
       return view('admin.portfolio.all',compact('portfolios'));
    }

 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.create');

        return view('admin.portfolio.create');
    }

 
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.create');

        $request->validate(
        [
            'title' => ['required','max:255'],
            'before' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'after' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'video' =>['nullable','max:63000'],
            'poster' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'descriotion' => ['required','max:63000'],
        ],
        [
            "title.required" => "* الزامی است.",
            "title.max" => "* حداکثر 255 کارکتر .",
            "video.max" => "* حداکثر 63000 کارکتر .",
            "before.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "before.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
            "after.required" => "* الزامی است.",
            "after.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "after.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
            "poster.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "poster.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
            "descriotion.required" => "* الزامی است.",
            "descriotion.max" => "* حداکثر 63000 کارکتر .",
        ]);

        if($request->status == Status::Active || $request->status == Status::Deactive)
        {
            $portfolio = Portfolio::create([
                'title'=> $request->title,
                'slug' => SlugService::createSlug(Portfolio::class, 'slug', $request->title),
                'descriotion'=> $request->descriotion,
                'video'=> $request->video,
                'status'=> $request->status,
            ]);


            if(isset($request->before))
            {
                $path = $this->imageService->path();
                $img = $this->imageService->upload($request->before,[
                    'original' => [
                        'w'=>getimagesize($request->before)[0],
                        'h'=>getimagesize($request->before)[1],
                    ],
                    'large' => [
                        'w'=>1023,
                        'h'=>507,
                    ],
                    'medium' => [
                        'w'=>362,
                        'h'=>291,
                    ],
                    'thumbnail' => [
                        'w'=>150,
                        'h'=>54,
                    ],
                ],$path);

                $before = Image::create([
                    'imageable_id'=> $portfolio->id,
                    'imageable_type'=>  get_class($portfolio),
                    'name'=> $img,
                    'alt'=> $request->title,
                    'title'=> $request->title,
                    'path'=> $path,
                ]);

                $portfolio->before =  $before->id;
                $portfolio->save();
            }


            if(isset($request->after))
            {
                $path = $this->imageService->path();
                $img = $this->imageService->upload($request->after,[
                    'original' => [
                        'w'=>getimagesize($request->after)[0],
                        'h'=>getimagesize($request->after)[1],
                    ],
                    'large' => [
                        'w'=>1023,
                        'h'=>507,
                    ],
                    'medium' => [
                        'w'=>362,
                        'h'=>291,
                    ],
                    'thumbnail' => [
                        'w'=>150,
                        'h'=>54,
                    ],
                ],$path);

                $after = Image::create([
                    'imageable_id'=> $portfolio->id,
                    'imageable_type'=>  get_class($portfolio),
                    'name'=> $img,
                    'alt'=> $request->title,
                    'title'=> $request->title,
                    'path'=> $path,
                ]);

                $portfolio->after =  $after->id;
                $portfolio->save();
            }


            if(isset($request->poster))
            {
                $path = $this->imageService->path();
                $img = $this->imageService->upload($request->poster,[
                    'original' => [
                        'w'=>getimagesize($request->poster)[0],
                        'h'=>getimagesize($request->poster)[1],
                    ],
                    'large' => [
                        'w'=>932,
                        'h'=>462,
                    ],
                    'medium' => [
                        'w'=>362,
                        'h'=>291,
                    ],
                    'thumbnail' => [
                        'w'=>150,
                        'h'=>54,
                    ],
                ],$path);

                $poster = Image::create([
                    'imageable_id'=> $portfolio->id,
                    'imageable_type'=>  get_class($portfolio),
                    'name'=> $img,
                    'alt'=> $request->title,
                    'title'=> $request->title,
                    'path'=> $path,
                ]);

                $portfolio->poster =  $poster->id;
                $portfolio->save();
            }


            toast('نمونه کار جدید ثبت شد.','success')->position('bottom-end');
        }

        return redirect(route('admin.portfolios.index'));
    }

  
    public function show($id)
    {
        //
    }

 
    public function edit(Portfolio $portfolio)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.edit');

        return view('admin.portfolio.edit',compact('portfolio'));
    }

 
    public function update(Request $request,Portfolio $portfolio)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.edit');

        $request->validate(
            [
                'title' => ['required','max:255'],
                'before' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'after' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'video' =>['nullable','max:63000'],
                'poster' =>'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'descriotion' => ['required','max:63000'],
            ],
            [
                "title.required" => "* الزامی است.",
                "title.max" => "* حداکثر 255 کارکتر .",
                "video.max" => "* حداکثر 63000 کارکتر .",
                "before.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "before.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
                "after.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "after.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
                "poster.max"=>"* حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "poster.mimes"=>"* فرمت های مجاز jpeg,png,jpg,webp",
                "descriotion.required" => "* الزامی است.",
                "descriotion.max" => "* حداکثر 63000 کارکتر .",
            ]);

            if($request->status == Status::Active || $request->status == Status::Deactive)
            {
                $portfolio->update([
                    'title'=> $request->title,
                    'slug' => SlugService::createSlug(Portfolio::class, 'slug', $request->title),
                    'descriotion'=> $request->descriotion,
                    'video'=> $request->video,
                    'status'=> $request->status,
                ]);


                if(isset($request->before))
                {
                    if($portfolio->before_img!=null)
                    {
                        $portfolio->before_img->destroyImage();
                    }


                    $path = $this->imageService->path();
                    $img = $this->imageService->upload($request->before,[
                        'original' => [
                            'w'=>getimagesize($request->before)[0],
                            'h'=>getimagesize($request->before)[1],
                        ],
                        'large' => [
                            'w'=>1280,
                            'h'=>458,
                        ],
                        'medium' => [
                            'w'=>426,
                            'h'=>220,
                        ],
                        'thumbnail' => [
                            'w'=>150,
                            'h'=>54,
                        ],
                    ],$path);


                    $before = Image::create([
                        'imageable_id'=> $portfolio->id,
                        'imageable_type'=>  get_class($portfolio),
                        'name'=> $img,
                        'alt'=> $request->title,
                        'title'=> $request->title,
                        'path'=> $path,
                    ]);

                    $portfolio->before =  $before->id;
                    $portfolio->save();
                }


                if(isset($request->after))
                {
                    if($portfolio->after_img!=null)
                    {
                        $portfolio->after_img->destroyImage();
                    }

                    $path = $this->imageService->path();
                    $img = $this->imageService->upload($request->after,[
                        'original' => [
                            'w'=>getimagesize($request->after)[0],
                            'h'=>getimagesize($request->after)[1],
                        ],
                        'large' => [
                            'w'=>1280,
                            'h'=>458,
                        ],
                        'medium' => [
                            'w'=>426,
                            'h'=>220,
                        ],
                        'thumbnail' => [
                            'w'=>150,
                            'h'=>54,
                        ],
                    ],$path);

                    $after = Image::create([
                        'imageable_id'=> $portfolio->id,
                        'imageable_type'=>  get_class($portfolio),
                        'name'=> $img,
                        'alt'=> $request->title,
                        'title'=> $request->title,
                        'path'=> $path,
                    ]);

                    $portfolio->after =  $after->id;
                    $portfolio->save();
                }


                if(isset($request->poster))
                {
                    if($portfolio->poster_img!=null)
                    {
                        $portfolio->poster_img->destroyImage();
                    }

                    $path = $this->imageService->path();
                    $img = $this->imageService->upload($request->poster,[
                        'original' => [
                            'w'=>getimagesize($request->poster)[0],
                            'h'=>getimagesize($request->poster)[1],
                        ],
                        'large' => [
                            'w'=>1280,
                            'h'=>458,
                        ],
                        'medium' => [
                            'w'=>426,
                            'h'=>220,
                        ],
                        'thumbnail' => [
                            'w'=>150,
                            'h'=>54,
                        ],
                    ],$path);

                    $poster = Image::create([
                        'imageable_id'=> $portfolio->id,
                        'imageable_type'=>  get_class($portfolio),
                        'name'=> $img,
                        'alt'=> $request->title,
                        'title'=> $request->title,
                        'path'=> $path,
                    ]);

                    $portfolio->poster =  $poster->id;
                    $portfolio->save();
                }


                toast('بروزرسانی انجام شد.','success')->position('bottom-end');
            }

            return redirect(route('admin.portfolios.index'));
    }

 
    public function destroy(Portfolio $portfolio)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.delete');

        if($portfolio->before_img!=null)
        {
            $portfolio->before_img->destroyImage();
        }

        if($portfolio->after_img!=null)
        {
            $portfolio->after_img->destroyImage();
        }

        if($portfolio->poster_img!=null)
        {
            $portfolio->poster_img->destroyImage();
        }

        if($portfolio->video!=null)
        {
            $this->remove_video($portfolio->video);
        }

        $portfolio->delete();
        toast('نمونه کار مورد نظر حذف شد.','error')->position('bottom-end');
        return back();
    }

    public function videoupload(Request $request)
    {
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

            $url =  url('/').'/'.$path.$video;

            return response()->json([
                'url'=>$url
            ],200);
    }

    public function remove_image(Image $image)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.edit');

        $image->destroyImage();
        return back();
    }

    public function remove_video($link)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('portfolios.edit');

        $home = url('/').'/';

        $file = str_replace($home,'',$link);
        if(file_exists($file))
        {
            File::delete($file);
        }
    }
}
