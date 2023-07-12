@extends('layouts.master')
@section('content')
<div class="holder">
    @include('layouts.header')

    <div class="col-12 d-flex justify-content-center mt-5">
        <div class="col-lg-5 rounded-xl shadow bg-white text-center">
            @if($model->status==App\Enums\PaymentStatus::paid)
                <img src="/images/front/check.png" alt="" class="position-relative" style="top: -45px">
                <h4>تراکنش با موفقیت انجام شد.</h4>
                <p>کد پیگیری خرید شما <strong>{{ $model->ref_id }}</strong> میباشد.</p>
            @elseIf($model->status==App\Enums\PaymentStatus::feild)
                <img src="/images/front/uncheck.png" alt="" class="position-relative" style="top: -45px">
                <h4>تراکنش ناموفق</h4>
                <p>در انجام تراکنش خطا رخ داد. لطفا مجدد تلاش کنید</p>
            @endif


            <div class="my-4">
                <a href="/" class="btn btn-dark">بازگشت به خانه</a>
            </div>
        </div>
    </div>


</div>
@stop

@push('css')
    <style>
        .holder{
            min-height: 100vh;
            background-image: url("/images/front/money-bg-pattern.jpg");
            background-size: auto;
            background-repeat: repeat;
        }
        .shadow{
            box-shadow: 0 1px 5px lightgray;
        }
    </style>
@endpush
