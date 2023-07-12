<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;
use App\Models\ArticleCategories;
use App\Enums\ArticleStatus;
use App\Enums\CommentStatus;
use App\Enums\Status;
use Carbon\Carbon;

class ArticleController extends Controller
{
     public function blog()
     {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $articles = Article::with('categories')->where('status',ArticleStatus::publish)->where('publishDateTime','<=',$now)
        ->filter()->orderBy('publishDateTime','desc')->paginate(3);
        $comments = Comment::with('commentable')->where('approved',CommentStatus::approved)->where('commentable_type','App\Models\Article')->orderBy('created_at','desc')->limit(5)->get();
        $categories = ArticleCategories::where('status',Status::Active)->orderBy('name','asc')->get();
        return view('website.blog.index',compact('articles','comments','categories'));
     }

     public function show($slug)
     {
         $now = Carbon::now()->format('Y-m-d H:i:s');
         $article = Article::with('categories','comments')->where('slug',$slug)->where('status',ArticleStatus::publish)->first();
         $lastArticles = Article::where('status',ArticleStatus::publish)->
         where('publishDateTime','<=',$now)->orderBy('publishDateTime','desc')->limit(5)->get();
         return view('website.blog.show',compact('article','lastArticles'));
     }
}
