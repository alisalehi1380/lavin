<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Number;

class NumberController extends Controller
{

     public function index()
     {
          //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('numbers.index'); 


          $numbers = Number::with('user')->orderBy('created_at','desc')->filter()->paginate(50);
          return view("admin.number",compact('numbers'));
     }
  
}
