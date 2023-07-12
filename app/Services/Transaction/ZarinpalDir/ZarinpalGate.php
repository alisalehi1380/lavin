<?php

namespace App\Services\Transaction\ZarinpalDir;

use App\Enums\PaymentStatus;
use App\Models\UsedDiscount;
use App\Models\Order;
use App\Models\ReservePayment;
use App\Models\Cart;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Transaction\Gateway;
use App\Services\PointService;
use Auth;
use App\Services\SMS;

class ZarinpalGate implements Gateway
{
    protected $info;

    public function setInfo($info)
    {
        // TODO: Implement setInfo() method.
        $this->info = $info;
    }

    public function pay()
    {
        if($this->info['model']=='App\Models\Order')
        {
            $model = Order::find($this->info['model_id']);
        }
        else if($this->info['model']=='App\Models\ReservePayment')
        {
            $model = ReservePayment::find($this->info['model_id']);
        }
 
        $MerchantID 	= $this->info['merchant_id'];
        $Amount 		= $model->total_price;
        $Description 	= "تراکنش زرین پال";
        $Email 			= Auth::user()->mobile;
        $Mobile 		= Auth::user()->email();
        $CallbackURL 	= $this->info['callBackUrl'];
        $ZarinGate 		= false;
        $SandBox 		= true;
 
        $zp = new Zarinpal();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);
      
        if(isset($result["Status"]) && $result["Status"] == 100)
        {
            // Success and redirect to pay
            $model->res_code = $result['Authority'];
            $model->sale_ref_id = $result['Authority'];
            $model->status = PaymentStatus::payding;
            $model->price = $model->total_price;
            $model->msg = 'سعی در پرداخت';
            $model->save();
            return $result["StartPay"];
        } 
        else 
        {
            $model->status = PaymentStatus::feild;
            $model->save();
            // error
            return response()->json(['message'=>$result["Message"], 'status'=>$result["Status"], 200]);
        }
    }

    public function verify()
    {
        if($this->info['model']=='App\Models\Order')
        {
            $model = Order::find($this->info['model_id']);
        }
        else if($this->info['model']=='App\Models\ReservePayment')
        {
            $model = ReservePayment::find($this->info['model_id']);
        }

        // TODO: Implement verify() method.
        $MerchantID 	= $this->info['merchant_id'];
        $Amount 		= $model->total_price;
        $ZarinGate 		= false;
        $SandBox 		= true;

        $zp 	= new Zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100)
        {
            //منقضی کرن کد تخفیف
            if($model->discount_id!=null)
            {
                $discount = UsedDiscount::create([
                    'user_id' => Auth::id(),
                    'discount_id' => $model->discount_id
                ]);
            }
         
            //خالی کردن سبد خرید
            Cart::where('user_id',Auth::id())->delete();

            // Success
            $model->update([
                'ref_id' => $result['RefID'],
                'status' => PaymentStatus::paid,
                'msg' => 'تراکنش با موفقیت انجام شد',
            ]);

            
            //بروزرسانی  موجودی انبار
            if(get_class($model)== "App\Models\Order")
            {
               $items = OrderItem::where('order_id',$model->id)->get();
               foreach($items as $item)
               {
                    $prodcut  = Product::find($item->product_id);
                    if($prodcut->stock > $item->count)
                    {
                        $prodcut->stock -= $item->count;
                    }
                    else
                    {
                        $prodcut->stock = 0;
                    }
                    $prodcut->save();               
                }
            }

            //بروزرسانی امتیاز کاربر
            if(get_class($model)== "App\Models\ReservePayment")
            {
               $detail = $model->reserve->detail;
               $pointService = new  PointService;
               $pointService->point($model->user_id,$detail);
            }

            //ارسال sms
             $sms = new SMS;
             $msg = $model->user->firstname.' '.$model->user->lastname." عزیز \n".
             "پرداخت شما با موفقیت انجام شد.\n".
             "کدپیگیری خدمت شما:\n".$result['RefID'].
             "\n\nکلینیک لاوین رشت";

            $sms->send(array($model->user->mobile),$msg);
 
        } 
        else 
        {
            // error
            $model->update([
                'status' => PaymentStatus::feild,
                'msg' => 'تراکنش ناموفق',
            ]);
        }

       return redirect(route('website.payments.result',['model'=>get_class($model),'model_id'=>$model->id]));
    }
}
