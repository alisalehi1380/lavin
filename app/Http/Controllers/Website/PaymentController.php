<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Transaction\Payment;
use App\Services\Transaction\MellatDir\MellatGate;
use App\Services\Transaction\ZarinpalDir\ZarinpalGate;
use App\Models\Order;
use App\Models\ReservePayment;
use App\Models\Cart;
use Auth;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
       if(Cart::where('user_id',Auth::id())->count()==0 && request('model')=="App\Models\Order")
       {
           alert()->warning('سبد خرید خالی است');
           return back();
       }  
        $model = request('model');
        $model_id = request('model_id');
        $getway = request('getway');
     
        $data =[
            'model'=> $model,
            'model_id'=> $model_id,
            'callBackUrl'   => route('website.payments.verify'),
            'getway'       => $getway,
            'merchant_id'   => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
        ];
   

        $payment = new Payment();
        switch ($getway) 
        {
            case 'zarinpal':
                $payment->setGateway(new ZarinpalGate());
                break;
            case 'melat':
                $payment->setGateway(new MellatGate());
                break;
        }
 
        $payment->addInfo($data);

        return redirect($payment->pay(),301) ;
    }

    public function verification()
    {
         
        $model = Order::where('sale_ref_id',$_GET['Authority'])->first();

        if($model==null)
        {
            $model = ReservePayment::where('sale_ref_id',$_GET['Authority'])->first();
        }
   
   
        $data =[
            'model'=> get_class($model),
            'model_id'=> $model->id,
            'getway'       => $model->getway,
            'merchant_id'   => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
        ];

        $payment = new Payment();

        switch ($model->getway) 
        {
            case 'zarinpal':
                $payment->setGateway(new ZarinpalGate());
                break;
            case 'melat':
                $payment->setGateway(new MellatGate());
                break;
        }
      
        $payment->addInfo($data);
     
        return $payment->verify();
    }

    public function result(Request $request)
    {
        $model = request('model');
        $model_id = request('model_id');

        if($model=='App\Models\Order')
        {
            $model = Order::find($model_id);
        }
        else if($model=='App\Models\ReservePayment')
        {
            $model = ReservePayment::find($model_id);
        }

        return view('website.transaction-result',compact('model'));
    }
}
