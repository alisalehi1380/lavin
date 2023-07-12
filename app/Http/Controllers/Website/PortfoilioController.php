<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Enums\Status;

class PortfoilioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('after_img')->where('status',Status::Active)->orderBy('created_at','desc')->paginate(8);
        return view('website.portfolio.index',compact('portfolios'));
    }

    public function show($slug)
    {
         $portfolio = Portfolio::with('before_img','after_img','poster_img')->where('slug',$slug)->where('status',Status::Active)->first();
        return view('website.portfolio.show',compact('portfolio'));
    }
    
}
