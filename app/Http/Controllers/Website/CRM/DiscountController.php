<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use Auth;

class DiscountController extends Controller
{
    public function index()
    {
       $discounts = Discount::whereHas('users',function($q){
            $q->where('user_id',Auth::id());
       })->paginate(10);
        return view('crm.discount.all',compact('discounts'));
    }
}
