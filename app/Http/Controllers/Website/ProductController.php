<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewGroup;
use App\Models\Product;
use App\Models\Review;
Use App\Enums\Status;
Use App\Enums\ReviewGroupType;
use App\Models\ProductCategory;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('status',Status::Active)->filter1()->paginate(18);
        $products = $products->appends(request()->query());
        $categories = ProductCategory::where('parent_id',0)->where('status',Status::Active)->orderby('name','asc')->get();
        return view('website.products.index',compact('products','categories'));
    }

    public function show($slug)
    {
        $product = Product::with('parent_cat','child_cat','images','reviews')->where('slug',$slug)->first();
         
        if($product->status == Status::Deactive)
        {
            return abort(404);
        }
 
        $others = Product::with('images')->where('child',$product->child)
        ->where('id','<>',$product->id)->offset(0)->limit(10)->get();
 
        $reviewGroups = ReviewGroup::where('type',ReviewGroupType::Shop)->where('status',Status::Active)->get();
 
        return view('website.products.show',compact('product','others','reviewGroups'));
    }

    public function reviwe(Product $product,Request $request)
    {
       $request->validate([
           'content'=> 'required|max:63000'
       ],[
           'content.required'=>'* محتوا بازخورد الزامی است.',
           'content.max' => '* حداکثر طول محتوا بازخورد 63000 کارکتر'
       ]);
 
       $content = $request->content;
       $request = $request->except('_token','content');
 
       $reviews = json_encode($request,true);
 
       $review =new Review;
       $review->user_id = Auth::id();
       $review->reviewable_type = get_class($product);
       $review->reviewable_id = $product->id;
       $review->content = $content;
       $review->reviews = $reviews;
       $review->save();

       toast('بازخورد با موفقیت  ثبت شد','success')->position('bottom-end');  
       return back();
    }

    public function subcat(Request $request)
    {
        $sub = ProductCategory::where('parent_id',$request->category)->where('status',Status::Active)->orderby('name','asc')->get();
        return response()->json(['sub'=>$sub],200);
    }
}
