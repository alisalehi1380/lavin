<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
     public function index()
     {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reviews.index');

        $reviews = Review::with('reviewable')->orderBy('created_at','desc')->paginate(10);
         
        return view('admin.reviews.all',compact('reviews'));
     }
}
