<?php


namespace App\Services\Transaction;

class Payment
{
    protected $gateway;

    public function setGateway(Gateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function addInfo($info)
    {
        $this->gateway->setInfo($info);
    }

    public function pay()
    {
        return $this->gateway->pay();
    }

    public function verify()
    {
        return $this->gateway->verify();
    }
}
