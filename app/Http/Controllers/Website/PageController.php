<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Enums\Status;

class PageController extends Controller
{
    public function gallery()
    {
        $galleries = Gallery::where('status',Status::Active)->orderBy('created_at','desc')->paginate(8);
        return view('website.gallery',compact('galleries'));
    }
}
