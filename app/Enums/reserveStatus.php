<?php


namespace App\Enums;


class ReserveStatus
{
    const   waiting  = '0';//درانتظار
    const   confirm  = '1';//تایید
    const   cancel = '2';//لغو
    const   secratry = '3';//ارجاع به منشی
    const   done = '4';//انجام شده
}