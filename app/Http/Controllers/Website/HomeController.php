<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\ArticleCategories;
use App\Models\Portfolio;
use App\Models\Admin;
use App\Models\Socialmedia;
use App\Models\Phone;
use App\Models\Message;
use App\Models\FAQ;
use App\Enums\Status;
use App\Enums\ArticleStatus;
use Carbon\Carbon;
use App\Services\SMS;

class HomeController extends Controller
{
     public function index()
     {
        $allservices = Service::with('details')->where('displayed',true)->where('status',Status::Active)->get();
        $doctors = Admin::with('doctor')->whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->paginate(10);
        $products = Product::with('thumbnail','images')->orderBy('created_at','desc')->where('status',Status::Active)->limit(5)->get();
        $articleCategories = ArticleCategories::with('articles.categories')->where('status',Status::Active)->
         whereHas('articles',function($q){
             $q->where('status',ArticleStatus::publish)->
             where('publishDateTime','<',Carbon::now()->format('Y-m-d H:i:s'))->orderBy('publishDateTime','desc');
         })->orderBy('name','asc')->get();
 

         $galleries = Gallery::with('images')->orderBy('created_at','desc')->where('status',Status::Active)->limit(9)->get();
         return view('index',compact('products','articleCategories','galleries','doctors','allservices'));
     }

     public function search()
     {
         $portfolios  = Portfolio::where('title','like','%'.request('search').'%')->orWhere('descriotion','like','%'.request('search').'%')->orderBy('created_at','desc')->get();
         $articles = Article::where('title','like','%'.request('search').'%')->orWhere('content','like','%'.request('search').'%')->orderBy('created_at','desc')->get();
         $doctors = Admin::with('doctor')->where('fullname','like','%'.request('search').'%')->whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->get();
 
         return view('website.search',compact('articles','portfolios','doctors'));
     }

     public function about()
     {
         return view('website.about');
     }

     public function contact()
     {
         $socialmedias = Socialmedia::where('status',Status::Active)->get();
         $phones = Phone::where('status',Status::Active)->get();
         return view('website.contact',compact('socialmedias','phones'));
     }

     public function message(Request $request)
     {
        $request->validate([
            'fullname'=> 'nullable|max:255',
            'mobile'=> 'nullable|min:11|max:11|regex:/^[0-9]+$/',
            'content'=> 'required|max:63000',
        ],
        [
           'fullname.max'=>'* حداکثر 255 کارکتر.',
           'mobile.min'=>'*  شماره موبایل صحیح نیست.',
           'mobile.max'=>'*  شماره موبایل صحیح نیست.',
           'regex.max'=>'*  شماره موبایل صحیح نیست.',
           'content.required'=>'* محتوا پیام را وارد نمایید.',
           'content.max'=>'* حداکثر 63000 کارکتر.',

        ]);

        Message::create([
            'fullname'=>$request->fullname,
            'mobile'=>$request->mobile,
            'content'=>$request->content,
        ]);

        alert()->success('پیام شما ثبت شد.', 'تبریک');
        return back();
        
     }


     public function doctor($doctor)
     {
        $doctor = Admin::with('doctor','services')->find($doctor);
        return  view('website.doctors.show',compact('doctor'));
     }

     public function faq()
     {
         $faqs = FAQ::where('display',Status::Active)->orderBy('created_at','asc')->get();
         return  view('website.faq',compact('faqs'));
     }
}
