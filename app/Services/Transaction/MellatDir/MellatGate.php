<?php


namespace App\Services\Transaction\MellatDir;

use App\Enums\FactorStatus;
use App\Models\Transaction;
use App\Services\Transaction\Gateway;
use Illuminate\Http\Request;
use SoapClient;

class MellatGate implements Gateway
{
    protected $bankUri = 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl';
    protected $info;
    public function pay()
    {
        try
        {
            $soapClient = new SoapClient($this->bankUri);
            $res = $soapClient->bpPayRequest($this->info);

            //return object: return :"0,9237456928347"
            //$res->return = "0,9237456928347";
            $res = explode(',',$res->return);
            if($res[0] == "0")
            {
                return view('user-panel.transactions.getway')->with(['tokenId'=> $res[1]]);
            }

        }
        catch(\Throwable $e)
        {
            dd($e);
            return false;
        }
    }

    public function verify()
    {

        $request = new Request();
        // TODO: Implement verify() method.
        $transaction = Transaction::where('id',$request->SaleOrderId)->with('factor')->first();
        $factor = $transaction->factor;

        $data = [
            'terminalId' 		=> config('app.melat_terminal'),
            'userName' 			=> config('app.melat_username'),
            'userPassword' 		=> config('app.melat_password'),
            'orderId' 			=> $request->SaleOrderId,
            'SaleOrderId' 			=> $request->SaleOrderId,
            'SaleReferenceId' 			=> $request->SaleReferenceId,
        ];

        if($this->_getverify($data))
        {
            //success
            if($this->_getSettle($data))
            {
                $transaction->update([
                    'status' => FactorStatus::Paid,
                    'ref_id' =>$request->RefId,
                    'sale_ref_id' =>$request->SaleReferenceId,
                    'res_code' =>$request->ResCode,
                    'msg' => 'تراکنش با موفقیت انجام شد.'
                ]);

                $factor->update(['status'=> FactorStatus::Paid]);

                return view('user-panel.transactions.result')->with([
                    'msg'=>'تراکنش با موفقیت انجام شد.',
                    'ResCode' => $request->ResCode,
                    'status' => FactorStatus::Paid
                ]);
            }
            else
            {
                $transaction->update([
                    'status' => FactorStatus::UnSuccessfulPayment,
                    'msg' => 'مشکل از تایید از سمت بانک',
                ]);

                $factor->update(['status'=> FactorStatus::UnSuccessfulPayment]);

                return view('user-panel.transactions.result')->with([
                    'msg'=>'تراکنش ناموفق بوده است. مبلغ شما حداکثر تا 72 ساعت دیگر بازگشت داده می شود.',
                ]);
            }
        }
        else
        {
            $transaction->update([
                'status' => FactorStatus::UnSuccessfulPayment,
                'msg' => 'مشکل از تایید از سمت بانک',
            ]);

            $factor->update(['status'=> FactorStatus::UnSuccessfulPayment]);

            return view('user-panel.transactions.result')->with([
                'msg'=>'تراکنش ناموفق بوده است. مبلغ شماحداکثر تا 72 ساعت دیگرُ بازگشت داده می شود.',
                'status' => FactorStatus::UnSuccessfulPayment
            ]);
        }
    }

    public function _getverify($data)
    {
        try
        {
            $soapClient = new SoapClient($this->bankUri);
            $res = $soapClient->bpVerifyRequest($data);

            //return object: return :"0,false"
            $res->return = "0";

            if($res->return=="0")
                return true;
            else
                return false;
        }
        catch(\Throwable $e)
        {
            dd($e);
            return false;
        }
    }

    public function _getSettle($data)
    {
        try
        {
            $soapClient = new SoapClient($this->bankUri);
            $res = $soapClient->bpSettleRequest($data);

            //return object: return :"0,false"
            $res->return = "0";

            if($res->return=="0")
                return true;
            else
                return false;
        }
        catch(\Throwable $e)
        {
            dd($e);
            return false;
        }
    }

    public function setInfo($info)
    {
        // TODO: Implement setInfo() method.
        $this->info = $info;
    }
}
