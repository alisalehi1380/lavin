<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Enums\Status;
use  Validator;
use App\Services\FunctionService;
use App\Services\ImageService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use \Morilog\Jalali\Jalalian;
use App\Models\Luck;

use function GuzzleHttp\json_decode;

class ProductController extends Controller
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
        $this->authorize('shop.products.index');

        $products = Product::with('parent_cat','child_cat','thumbnail')->withTrashed()->orderBy('created_at','desc')->paginate(10);
        return  view('admin.shop.products.all',compact('products'));
    }
 
    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.create');

        $parents = ProductCategory::where('parent_id',0)->where('status',Status::Active)->orderBy('name','desc')->get();
        return view('admin.shop.products.create',compact('parents'));
    }

   
    public function store(Request $request)
    { 
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.create');

        $special = isset($request->special)?true:false;
        if($special && !isset($request->specialDateTime))
        {
            Validator::extend('specialDateTime_validator',function(){return false;});
        }
        else
        {
            Validator::extend('special_date_time_validator  ',function(){return true;});
        }

        if($special && !isset($request->specialPrice))
        {
            Validator::extend('special_price_validator',function(){return false;});
        }
        else
        {
            Validator::extend('special_price_validator',function(){return true;});
        }


        $request->validate(
        [
            'name' => ['required','max:255'],
            'parent' => ['required','integer'],
            'child' => ['nullable','integer'],
            'description' => ['nullable','max:63000'],
            'price'=>'required|regex:/^[0-9]+$/', 
            'stock'=>'required|regex:/^[0-9]+$/',
            'specialDateTime' => ['special_date_time_validator','max:19'],
            'specialPrice'=> ['nullable','special_price_validator','regex:/^[0-9]+$/'], 
            'status' => ['required','integer'],
            'thumbnail' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            "name.required" => "* الزامی است.",
            "name.max" => "* حداکثر 255 کارکتر .",
            "parent.required" => "* الزامی است.",
            "description.max" => "* حداکثر 63000 کارکتر .",
            "price.required" => "* الزامی است.",
            "price.regex" => "* مقدار عددی وارد کنید.",
            "stock.required" => "* الزامی است.",
            "stock.regex" => "* مقدار عددی وارد کنید.",
            "specialPrice.special_price_validator" => "* الزامی است.",
            "specialPrice.regex" => "* مقدار عددی وارد کنید.",
            "specialDateTime.special_date_time_validator" => "* الزامی است.",
            "specialDateTime.regex" => "* مقدار عددی وارد کنید.",
            'thumbnail.required' => '* تصویر شاخص الزامی است.',
            "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
            "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
        ]);

        $specialDateTime=null;
 
        if(isset($request->specialDateTime))
        {
            $specialDateTime =  $this->fuctionService->faToEn($request->specialDateTime);
            $specialDateTime = Jalalian::fromFormat('Y/m/d H:i:s', $specialDateTime)->toCarbon("Y-m-d H:i:s");
        }

       if($request->status==Status::Active || $request->status==Status::Deactive)
       {
            $product = Product::create([
                'name'=> $request->name,
                'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
                'parent'=> $request->parent,
                'child'=> $request->child,
                'description'=> $request->description,
                'price'=> $request->price,
                'stock'=> $request->stock,
                'special'=> $special,
                'specialDateTime'=>$specialDateTime,
                'specialPrice'=> $request->specialPrice,
                'status'=> $request->status
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
                'w'=>263,
                'h'=>273,
            ],
        ],$path);

        $product->thumbnail()->create([
            'title' => $request->name,
            'alt' => $request->name,
            'name' => $thumbnail,
            'path'=>$path
        ]);
        
        toast('محصول جدید افزوده شد.','success')->position('bottom-end');   
       }
        
        return redirect(route('admin.shop.products.index'));

    }
 
    public function edit(Product $product)
    {  
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.edit');

        $product =  Product::with('thumbnail')->find($product->id);
        $parents = ProductCategory::where('parent_id',0)->where('status',Status::Active)->orderBy('name','desc')->get();
        return view('admin.shop.products.edit',compact('parents','product'));
    }
 
    public function update(Request $request,Product  $product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.edit');

        $special = isset($request->special)?true:false;
        if($special && !isset($request->specialDateTime))
        {
            Validator::extend('specialDateTime_validator',function(){return false;});
        }
        else
        {
            Validator::extend('special_date_time_validator  ',function(){return true;});
        }

        if($special && !isset($request->specialPrice))
        {
            Validator::extend('special_price_validator',function(){return false;});
        }
        else
        {
            Validator::extend('special_price_validator',function(){return true;});
        }

        $request->validate(
        [
            'name' => ['required','max:255'],
            'parent' => ['required','integer'],
            'child' => ['nullable','integer'],
            'description' => ['nullable','max:63000'],
            'price'=>'required|regex:/^[0-9]+$/', 
            'stock'=>'required|regex:/^[0-9]+$/',
            'specialDateTime' => ['special_date_time_validator','max:19'],
            'specialPrice'=> ['nullable','special_price_validator','regex:/^[0-9]+$/'], 
            'status' => ['required','integer'],
            'thumbnail' =>'image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            "name.required" => "* الزامی است.",
            "name.max" => "* حداکثر 255 کارکتر .",
            "parent.required" => "* الزامی است.",
            "description.max" => "* حداکثر 63000 کارکتر .",
            "price.required" => "* الزامی است.",
            "price.regex" => "* مقدار عددی وارد کنید.",
            "stock.required" => "* الزامی است.",
            "stock.regex" => "* مقدار عددی وارد کنید.",
            "specialPrice.special_price_validator" => "* الزامی است.",
            "specialPrice.regex" => "* مقدار عددی وارد کنید.",
            "specialDateTime.special_date_time_validator" => "* الزامی است.",
            "specialDateTime.regex" => "* مقدار عددی وارد کنید.",
            "thumbnail.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "thumbnail.image"=>"تنها تصویر قابل آپلود است.",
            "thumbnail.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
        ]);

        $specialDateTime=null;
 
        if(isset($request->specialDateTime))
        {
            $specialDateTime =  $this->fuctionService->faToEn($request->specialDateTime);
            $specialDateTime = Jalalian::fromFormat('Y/m/d H:i:s', $specialDateTime)->toCarbon("Y-m-d H:i:s");
        }

       if($request->status==Status::Active || $request->status==Status::Deactive)
       {
            $product->update([
                'name'=> $request->name,
                'slug' => SlugService::createSlug(Product::class, 'slug', $request->name),
                'parent'=> $request->parent,
                'child'=> $request->child,
                'description'=> $request->description,
                'price'=> $request->price,
                'stock'=> $request->stock,
                'special'=> $special,
                'specialDateTime'=>$specialDateTime,
                'specialPrice'=> $request->specialPrice,
                'status'=> $request->status
            ]);

            if(isset($request->thumbnail))
            {
                $product->thumbnail->destroyImage();
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
                        'w'=>263,
                        'h'=>273,
                    ],
                ],$path);

                $product->thumbnail()->create([
                    'title' => $request->name,
                    'alt' => $request->name,
                    'name' => $thumbnail,
                    'path'=>$path
                ]);
            }
        
            toast('بروزرسانی افزوده شد.','success')->position('bottom-end');   
       }
        
        return redirect(route('admin.shop.products.index'));
    }
 
    public function destroy(Product $product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.delete');

        $product->delete();
        toast(' محصول مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    } 
    
    public function recycle($id)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.delete');

        $level = Product::withTrashed()->find($id);
        $level->restore();
        toast('محصول مورد نظر بازیابی شد.','error')->position('bottom-end');        
        return back();
    }

    public function show(Product $product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.images.show');

        $images = ProductImage::where('product_id',$product->id)->get();
        return view('admin.shop.products.images',compact('images','product'));
    }

    public function imagestore(Request $request,Product $product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.images.store');

        
        $request->validate(
        [
            'title' => ['required','max:100'],
            'image' =>'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ],
        [
            "title.required" => "* الزامی است.",
            "title.max" => "* حداکثر 100 کارکتر .",
            "image.required" => "* الزامی است.",
            "image.max"=>"حداکثر حجم مجاز برای تصویر شما 2 مگابایت است.",
            "image.image"=>"تنها تصویر قابل آپلود است.",
            "image.mimes"=>"فرمت های مجاز jpeg,png,jpg,webp",
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
                'w'=>263,
                'h'=>273,
            ],
        ],$path);

    
        ProductImage::create([
           'product_id'=> $product->id,
           'name'=>  json_encode($image),
           'alt'=> $request->title,
           'title'=> $request->title,
           'path'=> $path,
        ]);

        toast('.عکس جدید افزوده شد','success')->position('bottom-end');        
        return back();
    }

    public function imagedelete(Product $product,ProductImage $image)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.images.delete');


        $image->deleteImage();
        toast('تصویر مورد نظر حذف شد.','error')->position('bottom-end');        
        return back();
    }

    public function show_attributes(Product $product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.attributes.show');

        return view('admin.shop.products.attributes',compact('product'));
    }

    public function update_attributes(Product $product,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.attributes.update');

        $request->validate(
        [
            'property' => ['required'],
            'value' => ['required'],
        ]);

        $attributes = array();
        foreach($request->property as $index=>$pr)
        {
            if($pr!=null && $pr!='' && $request->value[$index]!= null && $request->value[$index]!='')
            $attributes[$pr] =  $request->value[$index];
        }
 
        $attributes = json_encode($attributes);

        $product->attributes = $attributes;
        $product->save();
       
        return redirect(route('admin.shop.products.index'));
    }

    public function luckcreate(Product $Product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('services.details.luck.create');

        $luck = luck::where('lucktable_id',$Product->id)->where('lucktable_type',get_class($Product))->first();
 
        if($luck!=null)
        {
            alert()->error('این محصول قبلا به گردونه قرعه کشی اضافه شده است.');
            return back();
        }

        return view('admin.shop.products.luck',compact('Product'));
    }

    public function luckstore(Request $request,Product $Product)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.attributes.create');
        
        $pr=0;
        if(isset($request->probability))
        {
            $pr = $request->probability;
        }

        $probability = Luck::sum('probability')+$pr;

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
            'lucktable_id' => $Product->id,
            'lucktable_type' => get_class($Product),
            'probability' => $request->probability,
            'discount' => $request->discount,
        ]);

        return redirect(route('admin.luck.index'));
    }
    
}
