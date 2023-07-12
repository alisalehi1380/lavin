<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Enums\DeliveryStatus;
use Auth;

class BuyController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')->where('user_id',Auth::id())->filter()->orderBy('created_at','desc')->paginate(10);
        return  view('crm.buy',compact('orders'));
    }
}
