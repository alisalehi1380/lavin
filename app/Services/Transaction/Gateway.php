<?php


namespace App\Services\Transaction;


interface Gateway
{
    public function setInfo($info);
    public function pay();
    public function verify();
}
