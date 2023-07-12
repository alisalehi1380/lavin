@extends('crm.master')
    @section('script')
        <script type="text/javascript">
            $("#since-order-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#since-order-filter",
                textFormat: "yyyy/MM/dd HH:mm",
                isGregorian: false,
                modalMode: false,
                englishNumber: false,
                enableTimePicker: true,
                selectedDateToShow: new Date(),
                calendarViewOnChange: function(param1){
                console.log(param1);
                }
            });

            $("#until-order-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#until-order-filter",
                textFormat: "yyyy/MM/dd HH:mm",
                isGregorian: false,
                modalMode: false,
                englishNumber: false,
                enableTimePicker: true,
                selectedDateToShow: new Date(),
                calendarViewOnChange: function(param1){
                console.log(param1);
                }
            });
 

        </script>
    @endsection

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
                             <i class="fas fa-shopping-cart page-icon"></i>
                             خریدها
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
                                <div class="col-12 col-md-6">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>  
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">
                                             

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="res_code" class="control-label IRANYekanRegular">شماره پیگیری</label>
                                                <input type="text"  class="form-control input" id="res_code-filter" name="res_code" placeholder="شماره پیگیری" value="{{ request('res_code') }}">
                                            </div>

                                        </diV>

                                        <div class="row">

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="status-filter" class="control-label IRANYekanRegular">وضعیت پرداخت</label>
                                                 <select name="pay[]" id="pay-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... وضعیت  پرداخت را انتخاب نمایید"> 
                                                    <option value="{{ App\Enums\PaymentStatus::unpaid }}" @if(request('pay')!=null) {{ in_array(App\Enums\PaymentStatus::unpaid,request('pay'))?'selected':'' }} @endif>پرداخت نشده</option>
                                                    <option value="{{ App\Enums\PaymentStatus::payding }}" @if(request('pay')!=null) {{ in_array(App\Enums\PaymentStatus::payding,request('pay'))?'selected':'' }} @endif>درحال پرداخت</option>
                                                    <option value="{{ App\Enums\PaymentStatus::paid }}" @if(request('pay')!=null) {{ in_array(App\Enums\PaymentStatus::paid,request('pay'))?'selected':'' }} @endif>پرداخت شده</option>
                                                    <option value="{{ App\Enums\PaymentStatus::feild }}" @if(request('pay')!=null) {{ in_array(App\Enums\PaymentStatus::feild,request('pay'))?'selected':'' }} @endif>پرداخت ناموفق</option>
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="status-filter" class="control-label IRANYekanRegular">وضعیت تحویل</label>
                                                 <select name="delivery[]" id="delivery-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... وضعیت  تحویل را انتخاب نمایید"> 
                                                    <option value="{{ App\Enums\DeliveryStatus::waiting }}" @if(request('delivery')!=null) {{ in_array(App\Enums\DeliveryStatus::waiting,request('delivery'))?'selected':'' }} @endif>درانتظار</option>
                                                    <option value="{{ App\Enums\DeliveryStatus::posted }}" @if(request('delivery')!=null) {{ in_array(App\Enums\DeliveryStatus::posted,request('delivery'))?'selected':'' }} @endif>ارسال شده</option>
                                                    <option value="{{ App\Enums\DeliveryStatus::delivery }}" @if(request('delivery')!=null) {{ in_array(App\Enums\DeliveryStatus::delivery,request('delivery'))?'selected':'' }} @endif>تحویل داده شده</option>
                                                    <option value="{{ App\Enums\DeliveryStatus::repay }}" @if(request('delivery')!=null) {{ in_array(App\Enums\DeliveryStatus::repay,request('delivery'))?'selected':'' }} @endif>مرجوعی</option>
                                                </select>
                                            </div>

                                        </diV>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-order" class="control-label IRANYekanRegular">زمان خرید از تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="since-order-filter" name="since" value="{{ request('since') }}" readonly>
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-order" class="control-label IRANYekanRegular">زمان خرید تا تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="until-order-filter" name="until" value="{{ request('until') }}" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12">
                                                <label for="reciver-name" class="control-label IRANYekanRegular">دریافت کننده</label>
                                                <input type="text"  class="form-control input" id="reciver-filter" name="reciver" placeholder="نام،شماره موبایل،آدرس یا کدپستی را وارد کنید" value="{{ request('reciver') }}">
                                            </div>
                                        </diV>
 

                                        <div class="form-group col-12 d-flex justify-content-center mt-3">

                                            <button type="submit" class="btn btn-info col-lg-2 offset-lg-4 cursor-pointer">
                                                <i class="fa fa-filter fa-sm"></i>
                                                <span class="pr-2">فیلتر</span>
                                            </button>

                                            <div class="col-lg-2">
                                                <a onclick="reset()" class="btn btn-light border border-secondary cursor-pointer">
                                                    <i class="fas fa-undo fa-sm"></i>
                                                    <span class="pr-2">پاک کردن</span>
                                                </a>
                                            </div>

                                            <script>
                                                function reset()
                                                {
                                                    document.getElementById("res_code-filter").value = "";
                                                    document.getElementById("reciver-filter").value = "";
                                                    document.getElementById("since-order-filter").value = "";
                                                    document.getElementById("until-order-filter").value = "";
                                                    $("#delivery-filter").val(null).trigger("change");
                                                    $("#pay-filter").val(null).trigger("change");
 

                                                }
                                            </script>


                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">کاربر</b></th>
                                            <th><b class="IRANYekanRegular">زمان سفارش</b></th>
                                            <th><b class="IRANYekanRegular">مبلغ کل</b></th>
                                            <th><b class="IRANYekanRegular">شماره پیگیری</b></th>
                                            <th><b class="IRANYekanRegular">وضعیا پرداخت</b></th>
                                            <th><b class="IRANYekanRegular">وضعیا تحویل</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $index=>$order)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $order->user->firstname.' '.$order->user->lastname.' ('.$order->user->code.')' }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $order->datetime() }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ number_format($order->total_price)  }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $order->res_code }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @switch($order->status)
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
                                            </td>

                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @switch($order->delivery)
                                                        @case(App\Enums\DeliveryStatus::waiting)
                                                        <span class="badge badge-warning IR p-1">درانتظار</span>
                                                        @break
                                                        @case(App\Enums\DeliveryStatus::posted)
                                                        <span class="badge badge-success IR p-1">ارسال شده</span>
                                                        @break
                                                        @case(App\Enums\DeliveryStatus::delivery)
                                                        <span class="badge badge-primary IR p-1">تحویل داه شده</span>
                                                        @break
                                                        @case(App\Enums\DeliveryStatus::repay)
                                                        <span class="badge badge-danger IR p-1">مرجوعی</span>
                                                        @break
                                                    @endswitch
                                                </strong>
                                            </td>
                                            <td>

                                               <a class="font18 m-1" href="#info{{ $order->id }}" data-toggle="modal" title="جزئیات فروش">
                                                    <i class="fa fa-info-circle text-dark"></i>
                                                </a>

                                                <!-- info Modal -->
                                                <div class="modal fade" id="info{{ $order->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IR" id="newReviewLabel">جزئیات فروش</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body IR text-left">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p>کاربر:<br>{{ $order->user->firstname.' '.$order->user->lastname.' ('.$order->user->code.')' }}<p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>شماره موبایل کاربر:<br>{{ $order->user->mobile }}<p>
                                                                    </div>
                                                                </div>

                                                                <hr style="border:1px solid;">

                                                                 <div class="row mt-2">
                                                                     <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <table style="width: 100%"  class="table table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th class="IRANYekanRegular">ردیف</th>
                                                                                            <th class="IRANYekanRegular">نام محصول</th>
                                                                                            <th class="IRANYekanRegular">قیمت</th>
                                                                                            <th class="IRANYekanRegular">تعداد</th>
                                                                                            <th class="IRANYekanRegular">جمع</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($order->items as $index=>$item)
                                                                                        <tr>
                                                                                            <td class="IRANYekanRegular">{{ ++$index }}</td>
                                                                                            <td class="IRANYekanRegular">{{ $item->product_name }}</td>
                                                                                            <td class="IRANYekanRegular">{{ number_format($item->price) }}</td>
                                                                                            <td class="IRANYekanRegular">{{ number_format($item->count) }}</td>
                                                                                            <td class="IRANYekanRegular">{{ number_format($item->sum) }}</td>
                                                                                        </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                     </div>
                                                                 </div>

                                                                 <hr style="border:1px solid;">

                                                                 <div class="row">
                                                                    <div class="col-6">
                                                                        <p>جمع کل: {{ number_format($order->price) }} تومان<p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>تخفیف: {{ number_format($order->discount_price) }} تومان<p>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p>هزینه ارسال: {{ number_format($order->delivery_cost) }} تومان<p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>مبلغ قابل پرداخت: {{ number_format($order->total_price) }} تومان<p>
                                                                    </div>
                                                                </div>

                                                                <hr style="border:1px solid;">
                                                              
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <p>گیرنده:<br>{{ $order->full_name }}<p>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <p>شماره موبایل گیرنده:<br>{{ $order->mobile }}<p>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <p>آدرس گیرنده:<br>{{ $order->address }}<p>
                                                                    </div>
                                                                </div>

                                                               <hr style="border:1px solid;">
                                                              
                                                               <div class="row">
                                                                    <div class="col-6">
                                                                        <span>وضعیت پرداخت</span>
                                                                        @switch($order->status)
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
                                                                    </div>

                                                                    <div class="col-6">
                                                                        <span>وضعیت پرداخت</span>
                                                                        @switch($order->delivery)
                                                                            @case(App\Enums\DeliveryStatus::waiting)
                                                                            <span class="badge badge-warning IR p-1">درانتظار</span>
                                                                            @break
                                                                            @case(App\Enums\DeliveryStatus::posted)
                                                                            <span class="badge badge-success IR p-1">ارسال شده</span>
                                                                            @break
                                                                            @case(App\Enums\DeliveryStatus::delivery)
                                                                            <span class="badge badge-primary IR p-1">تحویل داه شده</span>
                                                                            @break
                                                                            @case(App\Enums\DeliveryStatus::repay)
                                                                            <span class="badge badge-danger IR p-1">مرجوعی</span>
                                                                            @break
                                                                        @endswitch
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="modal-footer">                                                
                                                                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $orders->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
