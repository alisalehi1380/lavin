<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{
    public function store(Article $article,Request $requast)
    {
        $requast->validate(
        [
            "fullname"=>"required|max:255",
            "email"=>"required|max:255|email",
            "comment"=>"required|max:63000",
        ]
        ,
        [
            "fullname.required"=>"* نام و نام خانوادگی الزامی است.",
            "fullname.max"=>"*  حداکثر 255 کارکتر مجاز است.",
            "email.required"=>"* آدرس ایمیل الزامی است(ایمیل شما محفوظ می ماند)",
            "email.email"=>"* آدرس ایمیل معتبر نمی باشد.",
            "comment.required"=>"* متن نظر الزامی است.",
        ]);

        Comment::create([
            'fullname'=>$requast->fullname,
            'email'=>$requast->email,
            'comment'=>$requast->comment,
            'commentable_id'=> $article->id,
            'commentable_type'=> get_class($article)  
        ]);

        alert()->success('نظر شما پس از تایید ادمین در وبسایت نمایش داده می شود.', 'تبریک');
        return back();
    }
}
