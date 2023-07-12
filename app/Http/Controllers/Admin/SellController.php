<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Enums\DeliveryStatus;
use \Morilog\Jalali\Jalalian;
use App\Services\SMS;

class SellController extends Controller
{
    public function index()
    {
         //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.sells.index');

        $orders = Order::with('items')->filter()->orderBy('created_at','desc')->paginate(10);
        return  view('admin.orders.all',compact('orders'));
    }

    public function update(Order $order,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('shop.products.sells.update');

        if($request->delivery == DeliveryStatus::waiting || $request->delivery == DeliveryStatus::posted ||
            $request->delivery == DeliveryStatus::delivery || $request->delivery == DeliveryStatus::repay)
        {
            //بروزرسانی موجودی انبار
            if( $request->delivery == DeliveryStatus::repay &&  $order->delivery != DeliveryStatus::repay)
            {
                $items = OrderItem::with('product')->where('order_id',$order->id)->get();
                foreach($items as $item)
                {
                  $product =  $item->product;
                  $product->stock += $item->count;
                  $product->save();
                }
            }
            else if( $request->delivery != DeliveryStatus::repay &&  $order->delivery == DeliveryStatus::repay)
            {
                $items = OrderItem::with('product')->where('order_id',$order->id)->get();
                foreach($items as $item)
                {
                  $product =  $item->product;
                  if($product->stock > $item->count)
                  {
                        $product->stock -= $item->count;
                  }
                  else
                  {
                        $product->stock = 0;
                  }
                
                  $product->save();
                }
            } 
            
             $order->delivery = $request->delivery;
             $order->save(); 
            
             //ارسال sms
             $sms = new SMS;

             if($order->delivery==DeliveryStatus::posted)
             {
                $msg = $order->user->firstname.' '.$order->user->lastname." عزیز \n".
                "سفارش شما ارسال شد.\n\nکلینیک لاوین رشت";

                $sms->send(array($order->user->mobile),$msg);
             }  
             else if($order->delivery==DeliveryStatus::delivery)
             {
                $msg = $order->user->firstname.' '.$order->user->lastname." عزیز \n".
                "سفارش شما تحویل داده شد.\n\nکلینیک لاوین رشت";

                $sms->send(array($order->user->mobile),$msg);
             }
             else if($order->delivery==DeliveryStatus::repay)
             {
                $msg = $order->user->firstname.' '.$order->user->lastname." عزیز \n".
                "سفارش شما مرجوع شد.\n\nکلینیک لاوین رشت";

                $sms->send(array($order->user->mobile),$msg);
            }


        }
        return back();
    }
}
