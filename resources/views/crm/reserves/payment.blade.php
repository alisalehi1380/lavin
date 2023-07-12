@extends('crm.master')

@section('content')

<div class="content-page">

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

        <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0 IR">
                         
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-dollar-sign page-icon"></i>
                             پرداخت
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                  
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                              <p class="IR">
                                                عنوان سرویس:{{ $payement->reserve->service_name }}
                                              </p>  
                                              
                                              <p class="IR">
                                                جزئیات سرویس:{{ $payement->reserve->detail_name  }}
                                              </p> 
                                                
                                              <strong class="IRANYekanRegular">
                                                    @switch($payement->status)
                                                        @case(App\Enums\PaymentStatus::unpaid)
                                                        <span class="badge badge-warning IR p-1">پرداخت نشده</span>
                                                        @break
                                                        @case(App\Enums\PaymentStatus::payding)
                                                        <span class="badge badge-success IR p-1">درحال پرداخت</span>
                                                        @break
                                                        @case(App\Enums\PaymentStatus::paid)
                                                        <span class="badge badge-primary IR p-1">پرداخت موفق</span>
                                                        @break
                                                        @case(App\Enums\PaymentStatus::feild)
                                                        <span class="badge badge-danger IR p-1">پرداخت ناموفق</span>
                                                        @break
                                                    @endswitch
                                                </strong>
                                            </address>
                                        </div> 

                                        @if($payement->status == App\Enums\PaymentStatus::paid)
                                        <div class="col-6">
                                            <address>
                                        
                                                <strong class="IRANYekanRegular">
                                                    @switch($payement->payway)
                                                        @case(App\Enums\PayWay::online)
                                                        <span class="badge badge-primary IR p-1">پرداخت آنلاین</span>
                                                        @break
                                                        @case(App\Enums\PayWay::cash)
                                                        <span class="badge badge-success IR p-1">پرداخت نقدی</span>
                                                        @break
                                                    @endswitch
                                                </strong>

                                                <p class="IR mt-2">
                                                     شماره تراکنش:{{ $payement->res_code }}
                                                </p> 
                                                
                                                @if($payement->payway == App\Enums\PayWay::online)
                                                <p class="IR mt-2">
                                                    درگاه پرداخت:
                                                    @switch($payement->getway)
                                                        @case('zarinpal')
                                                         زرین پال 
                                                        @break
                                                    @endswitch
                                                </p>  
                                                @endif

                                              
                                            </address>
                                        </div> 
                                        @endif

                                    </div> 
                                
                                    @if($payement->status != App\Enums\PaymentStatus::paid)
                                    <div class="row">
                                        <div class="col-12">
                                            <form action="{{ route('website.account.reserves.discount',$payement->reserve) }}" method="post">
                                                @csrf
                                                <label for="title" class="control-label IRANYekanRegular">کد تخفیف</label>
                                                <input type="text" class="form-control input text-right" name="code" id="code" placeholder="کد تخفیف را وارد کنید" value="{{ old('code')  }}">
                                                <input type="hidden" name="model"  value="{{ $payement->reserve->id  }}">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('discount') }} </span>
                                                <button class="btn btn-success" type="submite">اعمال کد تخفیف</button>
                                            </form>
                                        </div>  
                                    </div>
                                    @endif
                                   
                                    @if($payement->status != App\Enums\PaymentStatus::paid)

                                        <div class="row">
                                        
                                            <div class="col-12">
                                                <div class="float-right">
                                                    <p class="IR"><b>مبلغ سرویس:</b> <span class="float-right">{{ number_format($payement->price) }} تومان</span></p>
                                                    
                                                        @if(Session::has('offer'))
                                                            <p class="IR"><b>تخفیف:</b> <span class="float-right">{{ number_format(Session::get('offer')) }} تومان</span></p>
                                                        @endif
                                                        <h3 class="IR"><b>مبلغ قابل پرداخت:</b> <span class="float-right">{{ number_format($payement->price - Session::get('offer')) }}</span></h3>
                                                
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> 
                                        </div>
                                    
            
                                        <div class="mt-4 mb-1">
                                            <div class="text-right d-print-none">
                                                <form action="{{ route('website.account.reserves.pay',$payement) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="code" value="{{ Session::get('code') }}">
                                                    <input type="hidden" name="model"  value="{{ $payement->reserve->id  }}">
                                                    <button class="btn btn-primary" type="submite">پرداخت</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div> 
                            </div>  
                        </div>
                     </div>
                  </div>
                </div>
            </div>

        </div>
    </div>


@endsection
