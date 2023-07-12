<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategories;
use App\Models\Image;
use App\Services\FunctionService;
use Auth;
use App\Enums\Status;
use App\Enums\ArticleStatus;
use Cviebrock\EloquentSluggable\Services\SlugService;
use \Morilog\Jalali\Jalalian;
use App\Services\ImageService;


class ArticleController extends Controller
{
    private $imageService;
    private $fuctionService;

    public function __construct()
    {
        $this->imageService = new ImageService();
        $this->fuctionService = new FunctionService();
    }

 
    public function index()
    {
       
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.index');

        $articles = Article::with('categories')->orderBy('publishDateTime','desc')->filter()->paginate(10);
        return view('admin.article.all',compact('articles'));
    }
 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.create');

        $categories =  ArticleCategories::where('status',Status::Active)->orderBy('name','desc')->get();
        return view('admin.article.create',compact('categories'));
    }

  
    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.create');


       $request->validate(
            [
                'title' => ['required','max:255'],
                'content' => ['required'],
                'status' => ['required'],
                'categories' => ['required'],
                'publishDateTime' => ['required'],
                'tags' => ['nullable','max:255'],
                'thumbnail' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],
            [
                
                'title.required' => '* عنوان مقاله الزامی است.',
                'title.max' => '* حداکثر  طول مجاز  255 کارکتر می باشد.',              
                'content.required' => '* محتوا مقاله الزامی است.',
                'categories.required' => '* انتخاب دسته بندی الزامی است',
                'publishDateTime.required' => '* زمان انتشار الزامی است.',
                'tags.max' => '* حداکثر  طول مجاز  255 کارکتر می باشد.',              
                'thumbnail.required' => '* تصویر شاخص الزامی است.',
                "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
                "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
            ]
        );

 
        if($request->status == ArticleStatus::publish || $request->status == ArticleStatus::preview)
        {
            $datetime =  $this->fuctionService->faToEn($request->publishDateTime);
            $publishDateTime = Jalalian::fromFormat('Y/m/d H:i:s', $datetime)->toCarbon("Y-m-d H:i:s");
            

            $article = Article::create([
                'autor_id' => Auth::guard('admin')->id(),
                'title' => $request->title,
                'slug' => SlugService::createSlug(Article::class, 'slug', $request->title),
                'content' => $request->content,
                'publishDateTime' => $publishDateTime,
                'tags' => $request->tags,
                'status' => $request->status,
            ]);
            
            $path = $this->imageService->path();
            $image = $this->imageService->upload($request->thumbnail,[
                'original' => [
                    'w'=>getimagesize($request->thumbnail)[0],
                    'h'=>getimagesize($request->thumbnail)[1],
                ],
                'large' => [
                    'w'=>1023,
                    'h'=>507,
                ],
                'medium' => [
                    'w'=>370,
                    'h'=>370,
                ],
                'thumbnail' => [
                    'w'=>150,
                    'h'=>54,
                ],
            ],$path);
    
            $article->thumbnail()->create([
                'title' => $request->title,
                'alt' => $request->title,
                'name' => $image,
                'path'=>$path
            ]);
           
            $article->categories()->sync($request->categories);
            
            toast('مقاله جدید افزوده شد.','success')->position('bottom-end');   
            return redirect(route('admin.article.index'));
        }
        
    }

  
    public function show($id)
    {
        //
    }

  
    public function edit(Article $article)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.edit');

        $article = Article::with('categories')->where('id',$article->id)->first();
        $categories =  ArticleCategories::orderBy('name','desc')->get();
         return view('admin.article.edit',compact('article','categories'));
    }

   
    public function update(Request $request,Article $article)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.edit');
 
       $request->validate(
            [
                'title' => ['required','max:255'],
                'content' => ['required'],
                'status' => ['required'],
                'categories' => ['required'],
                'publishDateTime' => ['required'],
                'tags' => ['nullable','max:255'],
                'thumbnail' =>'image|mimes:jpeg,png,jpg,webp|max:2048',
            ],
            [
                'title.required' => '* عنوان مقاله الزامی است.',
                'title.max' => '* حداکثر طول مجاز 255 عدد می باشد.',
                'content.required' => '* محتوا مقاله الزامی است.',
                'publishDateTime.required' => '* زمان انتشار الزامی است.',
                'categories.required' => '* انتخاب دسته بندی الزامی است',
                'title.max' => '* حداکثر طول مجاز 255 عدد می باشد.',
                "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
                "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
                "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
            ]
        );
        
        if($request->status == ArticleStatus::publish || $request->status == ArticleStatus::preview)
        {
            $datetime =  $this->fuctionService->faToEn($request->publishDateTime);
            $publishDateTime =  Jalalian::fromFormat('Y/m/d H:i:s', $datetime)->toCarbon("Y-m-d H:i:s");
    
            $article->update([
                'title' => $request->title,
                'slug' => SlugService::createSlug(Article::class, 'slug', $request->title),
                'content' => $request->content,
                'publishDateTime' => $publishDateTime,
                'tags' => $request->tags,
                'status' => $request->status,
            ]);

            if($request->hasFile('thumbnail'))
            {

                $thumbnail = Image::where('imageable_type',get_class($article))->where('imageable_id',$article->id)->first();
   
                $thumbnail->destroyImage();

                $path = $this->imageService->path();
                $thumbnail = $this->imageService->upload($request->thumbnail,[
                    'original' => [
                        'w'=>getimagesize($request->thumbnail)[0],
                        'h'=>getimagesize($request->thumbnail)[1],
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
        
                $article->thumbnail()->create([
                    'title' => $request->name,
                    'alt' => $request->name,
                    'name' => $thumbnail,
                    'path'=>$path
                ]);
    
            }


            $article->categories()->sync($request->categories);

            // remove from images storage (ckeditor)
            $posttexts = Article::get('content');
            $dst = 'public/images/ckeditor/articles/';
            $this->fuctionService->remove_ckeditor($posttexts, $dst);
            
 
            toast('بروزرسانی انجام شد.','success')->position('bottom-end');   

            return redirect(route('admin.article.index'));
        }
    }
 
    public function destroy(Article $article)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('article.destroy');

        $article->delete();
        toast('مقاله مورد نظر حذف شد.','error')->position('bottom-end'); 
        return back();
    }

    public function uploadImage()
    {
        $this->validate(request(),[
            'upload' => 'required|mimes:jpeg,png,bmp'
        ]);
 
        $image = $this->fuctionService->upload(request()->file('upload'));

        return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$image}' , '')</script>";
    }

    public function ckeditor(Request $request)
    {
        if($request->hasFile('upload')) 
        {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(storage_path('app/public/images/ckeditor/articles'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/images/ckeditor/articles/'.$fileName);
            $msg = 'آپلود عکس با موفقیت انجام شد.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');

            echo $response;
        }
    }

}
