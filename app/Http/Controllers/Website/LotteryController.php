<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Luck;
use App\Models\Discount;
use App\Models\UsedDiscount;
use App\Models\ServiceDetail;
use App\Models\Product;
use App\Models\Notification;
use App\Enums\Status;
use App\Enums\DiscountType;
use App\Services\NotificationService;
use App\Services\SMS;
use Auth;



class LotteryController extends Controller
{
      private $notification;
      public function __construct()
      {
          $this->notification = new NotificationService;
      }

     public function index()
     {
         $lucks = Luck::with('lucktable')->get();
         $chance = array();

         $lucks = Luck::orderBy('probability','desc')->get();

         foreach($lucks as $luck)
         {
             $i=0;
             while($i < $luck->probability)
             {
                 array_push($chance,$luck->id);
                 ++$i;
             }
         }

        if($chance != null)
        {
            $win = $chance[rand(0,count($chance)-1)];
        }
        else
        {
            $win = 0;
        }
         return view('website.lottery',compact('lucks','win'));
     }

     public function start(Request $request)
     {
        $used = UsedDiscount::where('user_id',Auth::id())->first();
        if($used!=null)
        {
            return response()->json([
                'message'=>'شما قبلا در قرعه کشی شرکت کرده اید.',
            ],422);
        }

        $win = $request->win;
        $luck = Luck::find($win);

        $discount = Discount::create([
            'code'=>$this->code(),
            'unit'=> DiscountType::percet,
            'value'=> $luck->discount,
            'status'=> Status::Active
        ]);

        if($luck->lucktable_type== 'App\Models\ServiceDetail')
        {
            $service = ServiceDetail::find($luck->lucktable_id);
            $discount->services()->sync($service->id);
            $message = ' شما برنده '.$discount->value.' درصد تخفیف استفاده از سرویس '.$service->name.' شده اید.';
        }
        else if($luck->lucktable_type== 'App\Models\Product')
        {
            $product = Product::find($luck->lucktable_id);
            $discount->products()->sync($product->id);
            $message = ' شما برنده '.$discount->value.' درصد تخفیف استفاده از محصول '.$product->name.' شده اید.';
        }


        $discount->users()->sync(Auth::id());

        //ثبت کد تخیف
        UsedDiscount::create([
            'user_id'=>Auth::id(),
            'discount_id'=>$discount->id
        ]);

        //ارسال ناتفیکیشن
        $title = "مبارکتون باشه";
        $msg= Auth::user()->firstname.' '.Auth::user()->lastname." عزیز\n".$message."\nکد تخفیف خدمت شما:\n".$discount->code."\n\n کلینیک لاوین رشت";
        $audience = array(Auth::id());
        $this->notification->send($title,$msg,Status::Active,$audience);

        //ارسال sms
        $sms = new SMS;
        $sms->send(array(Auth::user()->mobile),$msg);

        return response()->json([
            'message'=> $message,
            'discount'=>$discount->code
        ],200);
     }

     public function code()
     {
          $code = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,10);
          $discount = Discount::where('code',$code)->first();
          if($discount!=null)
          {
             return $this->code();
          }

          return $code;
     }
}
