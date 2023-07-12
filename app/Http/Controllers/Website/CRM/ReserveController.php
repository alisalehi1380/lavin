<?php

namespace App\Http\Controllers\Website\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceReserve;
use App\Models\Admin;
use App\Models\Service;
use App\Models\ReviewGroup;
use App\Models\Review;
use App\Models\ReservePayment;
use App\Enums\Status;
use App\Enums\ReviewGroupType;
use App\Enums\PayWay;
use App\Models\ServiceDetail;
use App\Services\DiscountService;
use Auth;


class ReserveController extends Controller
{

    public function index()
    {
        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->get();
        $services= Service::orderBy('name','asc')->get();
        $reserves = ServiceReserve::with('review')->where('user_id',Auth::id())->filter()->orderBy('created_at','desc')->paginate(10);
        $reviewGroups = ReviewGroup::where('type',ReviewGroupType::Service)->where('status',Status::Active)->get();


        return view('crm.reserves.all',compact('reserves','doctors','services','reviewGroups'));
    }

    public function reviwe(ServiceReserve $reserve,Request $request)
    {
       $request->validate([
           'content'=> 'required|max:63000'
       ],[
           'content.required'=>'* محتوا بازخورد الزامی است.',
           'content.max' => '* حداکثر طول محتوا بازخورد 63000 کارکتر'
       ]);

       $content = $request->content;
       $request = $request->except('_token','content');
       $reviews = json_encode($request,true);

       $review = Review::where('reviewable_id',$reserve->id)->where('reviewable_type',get_class($reserve))->firstOrnew();
       $review->user_id = Auth::id();
       $review->reviewable_type = get_class($reserve);
       $review->reviewable_id = $reserve->id;
       $review->content = $content;
       $review->reviews = $reviews;
       $review->save();

       toast('بازخورد با موفقیت  ثبت شد','success')->position('bottom-end');
       return back();
    }

    public function payment(ServiceReserve $reserve)
    {

         $payement = ReservePayment::with('reserve.service')->where('reserve_id',$reserve->id)->first();

         if($payement==null)
         {
             $detail = ServiceDetail::find($reserve->detail_id);
            $payement = ReservePayment::with('reserve.service')->create([
                'reserve_id' => $reserve->id,
                'user_id' => $reserve->user_id,
                'price' => $detail->price,
            ]);
         }


        return view('crm.reserves.payment',compact('payement'));
    }

    public function discount(Request $request)
    {
        $discountService =  new DiscountService;

        if(isset($request->code) && $request->code!='')
        {
            $result = $discountService->discount(ServiceReserve::class,$request);
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

    public function pay(ReservePayment $payment,Request $request)
    {
        $offer =0;
        $discount_id = null;
        $getway = 'zarinpal';
        $discountService =  new DiscountService;
        if(isset($request->code) && $request->code!='')
        {
            $result = $discountService->discount(ServiceReserve::class,$request);
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

        $payment->discount_price = $offer;
        $payment->discount_price = $offer;
        $payment->total_price = $payment->price-$offer;
        $payment->discount_id = $discount_id;
        $payment->payway = PayWay::online;
        $payment->getway = $getway;
        $payment->save();

        return redirect(route('website.payments.pay',
        ['model' => get_class($payment),'model_id'=>$payment->id,'getway'=>'zarinpal']));
    }
}
