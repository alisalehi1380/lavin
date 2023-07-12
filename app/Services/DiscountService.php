<?php


namespace App\Services;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\ServiceReserve;
use App\Models\Product;
use App\Models\UsedDiscount;
use App\Enums\Status;
use App\Enums\DiscountType;
use Carbon\Carbon;
use Auth;
 
class DiscountService
{
    public function discount($model,$request)
    {  
        $code = $request->code;
        $result = array();
        $discount = Discount::with('users','products')->where('code',$code)->where('status',Status::Active)->first();
        if($discount==null)
        {
            $result['status']=false;
            $result['msg']='کد تخفیف معتبر نمی باشد.';
            return $result;
        }
       
  
       if($discount->expire!= null && $discount->expire<=Carbon::now()->format('Y-m-d H:i:s'))
        {
            $result['status']= false;
            $result['msg']=' این کد تخفیف منقضی شده است.';
            return $result;
        }
      
        $users = $discount->users->pluck('id')->toArray();
        if(!in_array(Auth::id(),$users))
        {
            $result['status']= false;
            $result['msg']='این کد تخفیف به شما اختصاص داده نشده است.';
            return $result;
        }

       $used = UsedDiscount::where('user_id',Auth::id())->where('discount_id',$discount->id)->first();
        if($used!=null)
        {
            $result['status']= false;
            $result['msg']='این کد تخفیف قبلا توسط شما استفاده شده است.';
            return $result;
        }
 
        if('App\Models\Product'==$model)
        {
            $products = $discount->products->pluck('id')->toArray();
            $carts = Cart::where('user_id',Auth::id())->get()->pluck('product_id')->toArray();
            
            foreach($products as $product)
            {
                if(in_array($product,$carts))
                {
                   if($discount->unit == DiscountType::toman)
                   {
                        $offer = $discount->value;
                        $typeDiscount= " مبلغ تخفیف ";
                   } 
                   else if($discount->unit == DiscountType::percet)
                   {
                        $goods =  Product::find($product);
                        if($goods->special==true && $goods->specialDateTime >Carbon::now()->format('Y-m-d H:i:s'))
                        {
                            $offer =  $goods->specialPrice*$discount->value/100;
                        }
                        else
                        {
                            $offer =  $goods->price*$discount->value/100;
                        }
    
                        $typeDiscount = $discount->value." % تخفیف بر روی ".$goods->name;
                   }
    
                   $result['status']= true;
                   $result['msg']='کد تخفیف بر روی سبد خرید شما اعمال شد.';
                   $result['typeDiscount']=$typeDiscount;
                   $result['offer']=$offer;
                   $result['code']=$code;
                   $result['discount_id']= $discount->id;
                   return $result;
                }
            }

            $result['status']= false;
            $result['msg']='این کد تخفیف به محصولات انتخابی شما اختصاص داده نشده است.';
            return $result;
        }
        else  if('App\Models\ServiceReserve'==$model)
        {
            $services = $discount->services->pluck('id')->toArray();
            $service = ServiceReserve::with('detail')->find($request->model);
             
            if(in_array($service->id,$services))
            {
                if($discount->unit == DiscountType::toman)
                {
                    $offer = $discount->value;
                    $typeDiscount= " مبلغ تخفیف ";
                } 
                else if($discount->unit == DiscountType::percet)
                {
                    $offer =  $service->detail->price*$discount->value/100;
                    $typeDiscount = $discount->value." % تخفیف ";
                }

                $result['status']= true;
                $result['msg']='کد تخفیف بر روی سرویس شما اعمال شد.';
                $result['typeDiscount']=$typeDiscount;
                $result['offer']=$offer;
                $result['code']=$code;
                $result['discount_id']= $discount->id;
                return $result;
            }
        

            $result['status']= false;
            $result['msg']='این کد تخفیف به سرویس انتخابی شما اختصاص داده نشده است.';
            return $result;
        }

    }
}