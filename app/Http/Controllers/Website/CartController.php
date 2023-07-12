<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Enums\Status;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\DiscountService;
use Auth;

class CartController extends Controller
{
     private $discountService;
    public function __construct()
    {
        $this->discountService = new DiscountService;
    }

    public function index()
    {
       $carts = Cart::with('user','product.thumbnail')->where('user_id',Auth::id())->get();
       $address = UserAddress::with('province','city')->where('user_id',Auth::id())->first();
       $mobile = Auth::user()->mobile;
       return view('website.cart.index',compact('carts','address','mobile'));
    }

    public function add2cart(Product $product)
    {
        $count=1;
        $cart =  Cart::where('user_id',Auth::id())->where('product_id',$product->id)->first();

        if($cart!=null)
        {
            $count += $cart->count;
        }

       if($product->stock<$count || $product->status==Status::Deactive)
       {
           alert()->error('موجودی کافی نمی باشد.', 'هشدار');
            return back();
       }

       if($cart!=null)
       {
            $cart->count = $count;
            $cart->save();
       }
       else
       {
           Cart::create([
               'user_id'=>Auth::id(),
               'product_id'=> $product->id,
               'count'=>1
           ]);
       }


       alert()->success('تبریک', 'سبد خرید بروز شد.');
       return back();
    }

    public function update(Request $requast)
    {
 
        foreach($requast->except('_token') as $product_id=>$count)
        {
            $product = Product::find($product_id);
          
            if($product->stock >= $count)
            {
                Cart::where('product_id',$product->id)->where('user_id',Auth::id())
                ->update(['count'=>$count]);
            }
            else
            {
                $msg = ' موجودی محصول'.$product->name.' تنها '.$product->stock.' عدد می باشد'; 
                alert()->error('هشدار',$msg);
            }
        }

        return back();
    }

    public function remove(Cart $cart)
    {
        $cart->delete();
        return back();
    }

    public function discount(Request $requast)
    {
        $code = $requast->code;
        if(isset($code) && $code!='')
        {
            $result = $this->discountService->discount(Product::class,$requast);
       
            if($result['status']==false)
            {
                alert()->error($result['msg'],'خطا');
                return back();
            }
            else
            {
               alert()->success($result['msg'],'تبریک');
               $typeDiscount = $result['typeDiscount'];
               $offer = $result['offer'];
               $code = $result['code'];
               return redirect()->back()->with(compact('typeDiscount','offer','code'));
            }
        }
        else
        {
            alert()->error('کد خفیف را وارد نمایید.','خطا');
            return back();
        }
    }

    public function clear()
    {
        Cart::where('user_id',Auth::id())->delete();


        return response()->json([
            'message'=>'سبد خرید خالی شد.'
            ],200);
    }

    public function order(Request $requast)
    {
        $requast->validate([
            'full_name'=>'required|max:255',
            'mobile'=>'required|min:11|max:11|regex:/^[0-9]+$/',
            'address'=>'required|max:255',
            'postal_code'=>'required|max:10|min:10|regex:/^[0-9]+$/',
        ],[
            'mobile.required'=>'* شماره موبایل الزامی است.',
            'mobile.min'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.max'=>' فرمت صحیح موبایل  ********091 ',
            'mobile.regex'=>' فرمت صحیح موبایل  ********091 ',
            'full_name.required'=>'* نام و نام خانوادگی الزامی است.',
            'full_name.max'=>'* نام و نام خانوادگی  حداکثر 255 کارکتر',
            'address.required'=>'* آدرس الزامی است.',
            'address.max'=>'* آدرس  حداکثر 255 کارکتر',
            'postal_code.required'=>'* کد پستی الزامی است.',
            'postal_code.max'=>'* کدپستی 10 رقمی است.',
            'postal_code.min'=>'* کدپستی 10 رقمی است.',
            'postal_code.regex'=>'* کدپستی معتبر نیست.'
        ]);

        $getway = 'zarinpal';
        $code = $requast->code;
 
        $postCost=0;
        $total =0;
        $offer =0;
        $discount_id = null;
        if(isset($code) && $code!='')
        {
            $result = $this->discountService->discount(Product::class,$requast);

            if($result['status']==false)
            {
                alert()->error($result['msg'],'خطا');
                return back();
            }
            else
            {
               $discount_id = $result['discount_id'];
               $offer = $result['offer'];
            }
        }

        $order = Order::create([
            'user_id'=>Auth::id(), 
            'discount_price' =>$offer,
            'delivery_cost'=>$postCost,
            'discount_id'=>$discount_id,
            'full_name'=>$requast->full_name,
            'address'=>$requast->address.'/n:کدپستی '.$requast->postal_code,
            'mobile'=>$requast->mobile,
            'getway'=>$getway,
        ]);

        $carts = Cart::with('product')->where('user_id',Auth::id())->get();
        foreach($carts as $cart)
        {
           $item = OrderItem::create([
                'order_id'=> $order->id,
                'product_id'=> $cart->product->id,
                'product_name'=>$cart->product->name,
                'price' =>$cart->product->price,
                'count' =>$cart->count,
                'sum'=>$cart->product->price*$cart->count,
            ]);

            $total  += $cart->product->price*$cart->count;
        }

        $order->price = $total;
        $order->total_price = $total+$postCost-$offer;
        $order->save();

 
       return redirect(route('website.payments.pay', 
       ['model' => get_class($order),'model_id'=>$order->id,'getway'=>'zarinpal']));
    }
}
