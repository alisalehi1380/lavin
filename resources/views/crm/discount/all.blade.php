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
                             <i class="fas fa-percent page-icon"></i>
                             کدهای تخفیف
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">     
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">کد</b></th>
                                            <th><b class="IRANYekanRegular">واحد</b></th>
                                            <th><b class="IRANYekanRegular">مقدار</b></th>
                                            <th><b class="IRANYekanRegular">انقضاء</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                   
                                        @foreach($discounts as $index=>$discount)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $discount->code }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                @if($discount->unit==App\Enums\DiscountType::percet)
                                                    درصد(%)
                                                @elseif($discount->unit==App\Enums\DiscountType::toman)
                                                    مبلغ(تومان)
                                                @endif
                                            </td>
                                            <td><strong class="IRANYekanRegular">{{ $discount->value }}</strong></td>
                                            <td>
                                                @if($discount->expire!=null)
                                                <strong class="IRANYekanRegular">
                                                {{ \Morilog\Jalali\CalendarUtils::convertNumbers(\Morilog\Jalali\CalendarUtils::strftime('H:i:s - Y/m/d',strtotime($discount->expire))) }}
                                                </strong>
                                                @else
                                                نامحدود
                                                @endif
                                            </td>
                                            <td>
                                           
                                                @if($discount->used() == false)
                                                <span class="badge badge-info IR  p-1">استفاده شده</span>
                                                @elseif($discount->expired())
                                                <span class="badge badge-danger IR  p-1">منقضی شده</span>
                                                @elseif($discount->used())
                                                <span class="badge badge-primary IR  p-1">قابل استفاده</span>
                                                @endif  
                                            </td>
                    
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $discounts->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
