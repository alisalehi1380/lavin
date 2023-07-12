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
                            <ol class="breadcrumb m-0">
                         
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
                                                
                                              <p class="IR">
                                               مبلغ قابل پرداخت:{{ number_format($payement->price) }} تومان
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
                                
            
                                        <div class="col-6">
                                            <form action="{{ route('admin.reserves.pay',$payement) }}" method="post">
                                                @csrf
                                                <label for="title" class="control-label IRANYekanRegular">شناسه پرداخت</label>
                                                <input type="text" class="form-control input text-right" name="res_code" id="res_code" placeholder="شناسه پرداخت را وارد کنید" value="{{ old('code')  }}">
                                                <input type="hidden" name="model"  value="{{ $payement->reserve->id  }}">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('res_code') }} </span>
                                                 <button class="btn btn-primary" type="submite">پرداخت</button>
                                            </form>
                                        </div> 
                                    </div>
            
                                   
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
