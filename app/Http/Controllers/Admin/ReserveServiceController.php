<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceReserve;
use App\Models\ReservePayment;
use App\Enums\ReserveStatus;
use App\Enums\Status;
use App\Enums\PayWay;
use App\Enums\PaymentStatus;
use App\Models\Admin;
use App\Models\ServiceDetail;
use App\Services\FunctionService;
use App\Services\ReserveService;
use \Morilog\Jalali\Jalalian;
use App\Services\DiscountService;
use App\Services\SMS;
use App\Services\PointService;

class ReserveServiceController extends Controller
{
    private $fuctionService;
    private $reserveService;

    public function __construct()
    {
        $this->reserveService = new ReserveService();
        $this->fuctionService = new FunctionService();
    }


    public function index()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.index');

        $doctors = Admin::whereHas('roles', function($q){$q->where('name', 'doctor');})->orderBy('fullname','asc')->get();
        $secretaries = Admin::whereHas('roles', function($q){$q->where('name', 'secretary');})->orderBy('fullname','asc')->get();
        $asistants = Admin::whereHas('roles', function($q){$q->where('name', 'asistant1');})->orderBy('fullname','asc')->get();
 
        $services= Service::orderBy('name','asc')->get();
 
        $services= Service::orderBy('name','asc')->get();
        $reserves = ServiceReserve::with('user','doctor','review')->filter()->orderBy('created_at','desc')->paginate(10);
        return view('admin.reserves.all',compact('reserves','services','doctors','secretaries','asistants'));
    }

    public function create()
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.create');

        $services = Service::where('status',Status::Active)->whereHas('details')->orderBy('name','asc')->get();
        return view('admin.reserves.create',compact('services'));
    }

    public function store(Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.create');


        $request->validate([
            'user'=>'required|numeric',
            'service'=>'required|numeric',
            'detail'=>'required|numeric',
            'doctor'=>'required|numeric',
        ],
        [
            'user.required'=>'* الزامی است.',
            'user.numric'=>'* معتبر نیست.',
            'service.required'=>'* الزامی است.',
            'service.numric'=>'* معتبر نیست.',
            'detail.required'=>'* الزامی است.',
            'detail.numric'=>'* معتبر نیست.',
            'doctor.required'=>'* الزامی است.',
            'doctor.numric'=>'* معتبر نیست.',
        ]);

        $this->reserveService->reserve($request->user,$request->service,$request->detail,$request->doctor);

        toast('رزرو جدید ثبت شد.','success')->position('bottom-end');

        return redirect(route('admin.reserves.index'));

    }

    public function edit(ServiceReserve $reserve)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.edit');


        $services = Service::where('status',Status::Active)->whereHas('details')->orderBy('name','asc')->get();
        $details = ServiceDetail::where('status',Status::Active)->where('service_id',$reserve->service_id)->orderBy('name','asc')->get();
        $doctors = ServiceDetail::with('doctors')->find($reserve->detail_id);
        $doctors = $doctors->doctors;

        return view('admin.reserves.edit',compact('reserve','services','details','doctors'));
    }

    public function update(ServiceReserve $reserve,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.edit');

        $request->validate([
            'service'=>'required|numeric',
            'detail'=>'required|numeric',
            'doctor'=>'required|numeric',
        ],
        [
            'service.required'=>'* الزامی است.',
            'service.numric'=>'* معتبر نیست.',
            'detail.required'=>'* الزامی است.',
            'detail.numric'=>'* معتبر نیست.',
            'doctor.required'=>'* الزامی است.',
            'doctor.numric'=>'* معتبر نیست.',
        ]);
        
        if($request->status == ReserveStatus::waiting || $request->status == ReserveStatus::confirm
        || $request->status == ReserveStatus::cancel  || $request->status == ReserveStatus::done)
        {
            if(!isset($request->time) && ReserveStatus::confirm)
            {
                alert()->error('خطا','جهت تایید رزور زمان مراجعه را مشخص نمایید.');
                return back();
            }
            else if(isset($request->time))
            {
                $time =  $this->fuctionService->faToEn($request->time);
                $time = Jalalian::fromFormat('Y/m/d H:i', $time)->toCarbon("Y-m-d H:i");
            }
            else
            {
                $time = null;
            }


            $service = Service::find($request->service);
            $detail = ServiceDetail::find($request->detail);

            $reserve->update([
                'service_id'=>$service->id,
                'service_name'=>$service->name,
                'detail_id'=> $detail->id,
                'detail_name'=> $detail->name,
                'doctor_id'=>$request->doctor,
                'time' =>  $time,
                'status'=>$request->status
            ]);

            //ارسال sms
             $sms = new SMS;
            if($reserve->status == ReserveStatus::confirm && $reserve->time!=null)
            {
                $msg = $reserve->user->firstname.' '.$reserve->user->lastname." عزیز \n".
                "سرویس رزرو شده شما مورد تایید قرار گرفت.\nجهت پرداخت آنلاین به حساب کاربری خود مراجمعه نمایید.\nزمان مراجعه شما به کلینیک:\n".
                en2fa($request->time)."\n\nکلینیک لاوین رشت";
                $sms->send(array($reserve->user->mobile),$msg);
            }
            else if($reserve->status == ReserveStatus::cancel)
            {
                $msg = $reserve->user->firstname.' '.$reserve->user->lastname." عزیز \n".
                "سرویس رزرو شده شما لغو گردید.\n\nکلینیک لاوین رشت";
                $sms->send(array($reserve->user->mobile),$msg);
            }
            else if($reserve->status == ReserveStatus::done)
            {
                $msg = $reserve->user->firstname.' '.$reserve->user->lastname." عزیز \n ضمن تشکر از اعتماد شما،".
                "لطفا جهت شرکت در نظرسنجی در خصوص سرویس دریافتی به حساب کاربری خود مراجعه نمایید.\n\nکلینیک لاوین رشت";
                $sms->send(array($reserve->user->mobile),$msg);
            }

   

            toast('بروزرسانی انجام شد.','success')->position('bottom-end');
        }

        return redirect(route('admin.reserves.index'));

    }

    public function payment(ServiceReserve $reserve)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.payment');

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


        return view('admin.reserves.payment',compact('payement'));
    }

     public function pay(ReservePayment $payment,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.pay');

        $request->validate([
            'res_code'=>'required'
        ],[
            'res_code.required'=>'* شناسه پرداخت را وارد نمایید.'
        ]);

        $offer =0;
        $discount_id = null;
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
        $payment->total_price = $payment->price-$offer;
        $payment->discount_id = $discount_id;
        $payment->ref_id = $request->res_code;
        $payment->res_code = $request->res_code;
        $payment->payway = PayWay::cash;
        $payment->status = PaymentStatus::paid;
        $payment->save();

 
        //بروزرسانی امتیاز کاربر
        $detail = $payment->reserve->detail;
        $pointService = new  PointService;
        $pointService->point($payment->user_id,$detail);
        return back();
    }


    public function secratry(ServiceReserve $reserve,Request $request)
    {
        $request->validate([
            'secratry' => "required|exists:admins,id"
        ],
        [
            "secratry.required"=>"انتخاب منشی الزامی است."
        ]);

        $reserve->secratry_id = $request->secratry;
        $reserve->status = reserveStatus::secratry;
        $reserve->save();

        return back();
    }

    public function done(ServiceReserve $reserve,Request $request)
    {
        //اجازه دسترسی
        config(['auth.defaults.guard' => 'admin']);
        $this->authorize('reserves.done');

        $request->validate(
        ["asistant"=> "required|exists:admins,id"],
        ["required"=>"انجام دهنده کار را مشخص کنید."]);

        $reserve->asistant_id = $request->asistant;
        $reserve->status = ReserveStatus::done;
        $reserve->save();

        return back();
    }

}
