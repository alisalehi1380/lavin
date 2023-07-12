<?php

namespace App\Enums;

class TicketStatus
{
    const   Waiting = '0'; //در انتظار پاسخ
    const   Pending  = '1'; //درحال بررسی
    const   Answerd  = '2'; //پاسخ داده شده
    const   Close = '3'; //بسته شده
}