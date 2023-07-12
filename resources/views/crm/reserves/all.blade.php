@extends('crm.master')


    @section('script')
        <script type="text/javascript">
            $("#since-reserve-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#since-reserve-filter",
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

            $("#until-reserve-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#until-reserve-filter",
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


            $("#since-round-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#since-round-filter",
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

            $("#until-round-filter").MdPersianDateTimePicker({
                targetDateSelector: "#showDate_class",
                targetTextSelector: "#until-round-filter",
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

            // this will set a value in rate input based on star that has been clicked
            function changeRate(star){
                let stars = star.parentElement.children;
                let input = star.parentElement.nextElementSibling;
                let value = star.dataset.tooltip;
                $.map(stars, function(item){
                    $(item).removeClass('text-warning-force');
                });
                for (let i = 0; i < value; i++) {
                    $(stars[i]).addClass('text-warning-force');
                }
                input.value = value;
            }

            // change star color when hover
            function changeStarColor(star) {
                let stars = star.parentElement.children;
                let value = star.dataset.tooltip;
                for (let i = 0; i < value; i++) {
                    $(stars[i]).addClass('text-warning');
                }
            }

            // reset star color when mouse leave
            function removeStarColor(star) {
                let stars = star.parentElement.children;
                $.map(stars, function(item){
                    $(item).removeClass('text-warning');
                });
            }

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
                             <i class="fab fa-first-order-alt page-icon"></i>
                             رزروها
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
                                                <label for="user-filter" class="control-label IRANYekanRegular">کاربر</label>
                                                <input type="text"  class="form-control input" id="user-filter" name="user" placeholder="نام یا شماره موبایل را وارد کنید" value="{{ request('user') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="name" class="control-label IRANYekanRegular">سرویسها</label>
                                                 <select name="services[]" id="service-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... سرویس‌های مورد نظر را انتخاب نمایید"> 
                                                    @foreach($services as $service)
                                                    <option value="{{ $service->id }}" @if(request('services')!=null) {{ in_array($service->id,request('services'))?'selected':'' }} @endif>{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </diV>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="name" class="control-label IRANYekanRegular">پزشکان</label>
                                                 <select name="doctors[]" id="doctors-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... پزشکان مورد نظر را انتخاب نمایید"> 
                                                    @foreach($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" @if(request('doctors')!=null) {{ in_array($doctor->id,request('doctors'))?'selected':'' }} @endif>{{ $doctor->fullname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="status-filter" class="control-label IRANYekanRegular">وضعیت</label>
                                                 <select name="status[]" id="status-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... وضعیت مورد نظر را انتخاب نمایید"> 
                                                    <option value="{{ App\Enums\ReserveStatus::waiting }}" @if(request('status')!=null) {{ in_array(App\Enums\ReserveStatus::waiting,request('status'))?'selected':'' }} @endif>درانتظار</option>
                                                    <option value="{{ App\Enums\ReserveStatus::confirm }}" @if(request('status')!=null) {{ in_array(App\Enums\ReserveStatus::confirm,request('status'))?'selected':'' }} @endif>تایید</option>
                                                    <option value="{{ App\Enums\ReserveStatus::cancel }}" @if(request('status')!=null) {{ in_array(App\Enums\ReserveStatus::cancel,request('status'))?'selected':'' }} @endif>لغو</option>
                                                    <option value="{{ App\Enums\ReserveStatus::done }}" @if(request('status')!=null) {{ in_array(App\Enums\ReserveStatus::done,request('status'))?'selected':'' }} @endif>انجام شده</option>
                                                </select>
                                            </div>

                                        </diV>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-reserve" class="control-label IRANYekanRegular">زمان رزرو از تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="since-reserve-filter" name="since_reserve" value="{{ request('since-reserve') }}" readonly>
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-reserve" class="control-label IRANYekanRegular">زمان رزرو تا تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="until-reserve-filter" name="until-reserve" value="{{ request('until-reserve') }}" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-round" class="control-label IRANYekanRegular">زمان نوبت دهی از تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="since-round-filter" name="since-round" value="{{ request('since-round') }}" readonly>
                                            </div>

                                            <div class="form-group justify-content-center col-12 col-md-6">
                                                <label for="since-round" class="control-label IRANYekanRegular">زمان نوبت دهی تا تاریخ</label>
                                                <input type="text"   class="form-control text-center" id="until-round-filter" name="until-round" value="{{ request('until-round') }}" readonly>
                                            </div>
                                        </div>

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
                                                    document.getElementById("user-filter").value = "";
                                                    document.getElementById("since-reserve-filter").value = "";
                                                    document.getElementById("until-reserve-filter").value = "";
                                                    document.getElementById("since-round-filter").value = "";
                                                    document.getElementById("until-round-filter").value = "";
                                                    $("#doctors-filter").val(null).trigger("change");
                                                    $("#status-filter").val(null).trigger("change");
                                                    $("#service-filter").val(null).trigger("change");

                                                }
                                            </script>


                                        </div>
                                    </form>
                                </div>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">سرویس</b></th>
                                            <th><b class="IRANYekanRegular">جزئیات</b></th>
                                            <th><b class="IRANYekanRegular">پزشک</b></th>
                                            <th><b class="IRANYekanRegular">رزور</b></th>
                                            <th><b class="IRANYekanRegular">نوبت</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reserves as $index=>$reserve)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $reserve->service_name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $reserve->detail_name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $reserve->doctor->fullname ?? "" }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    {{ $reserve->reserve_time() }}
                                                </strong>
                                            </td>
                                            <td>
                                                @if($reserve->time!=null)
                                                <strong class="IRANYekanRegular">
                                                    {{ $reserve->round_time() }}
                                                </strong>
                                                @endif
                                            </td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @switch($reserve->status)
                                                        @case(App\Enums\ReserveStatus::waiting)
                                                        <span class="badge badge-warning IR p-1">درانتظار</span>
                                                        @break
                                                        @case(App\Enums\ReserveStatus::confirm)
                                                        <span class="badge badge-success IR p-1">تایید</span>
                                                        @break
                                                        @case(App\Enums\ReserveStatus::cancel)
                                                        <span class="badge badge-danger IR p-1">لغو</span>
                                                        @break
                                                        @case(App\Enums\ReserveStatus::done)
                                                        <span class="badge badge-primary IR p-1">انجام شده</span>
                                                        @break
                                                    @endswitch
                                                </strong>
                                            </td>

                                            <td>
                                                @if($reserve->status == App\Enums\ReserveStatus::confirm)
                                                <a href="{{ route('website.account.reserves.payment',$reserve) }}" class="btn btn-icon font-20" title="پرداخت">
                                                    <i class="fas fa-dollar-sign text-primary cusrsor"></i>
                                                </a>
                                                @endif
                                                
                                                @if($reserve->status != App\Enums\ReserveStatus::waiting)
                                                <a class="btn  btn-icon font-20" href="#review{{ $reserve->id }}" data-toggle="modal" title="نظرسنجی">
                                                    <i class="fa fa-comment text-danger cusrsor"></i>
                                                </a>

                                                <div class="modal fade" id="review{{ $reserve->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IR" id="newReviewLabel">نظرسنجی</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                           
                                                            <form action="{{ route('website.account.reserves.reviwe', $reserve) }}" method="POST" id="reviwe-form">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    @if($reserve->review==null)
                                                                    <div class="row">
                                                                       
                                                                        <div class="col-12">
                                                                            @foreach($reviewGroups as $reviewGroup)
                                                                            <div class="col-12 pt-2 pb-2 px-0 row mx-0 mt-0">
                                                                                <div class="col-3  text-dark small">{{ $reviewGroup->title  }}</div>
                                                                                <div class="col-9  text-nowrap review-rating">
                                                                                    <i class="fa fa-star position-relative" data-tooltip="1" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                                                    <i class="fa fa-star position-relative" data-tooltip="2" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                                                    <i class="fa fa-star position-relative" data-tooltip="3" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                                                    <i class="fa fa-star position-relative" data-tooltip="4" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                                                    <i class="fa fa-star position-relative" data-tooltip="5" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                                                </div>
                                                                                <input type="hidden" name="{{ $reviewGroup->title  }}">
                                                                            </div>
                                                                            @endforeach
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <textarea name="content" id="content" style="height:180px;"></textarea>
                                                                        </div>

                                                                    </div>
                                                                    @else 
                                                                        <div class="row">
                                                                            <div class="col-12">

                                                                                 @foreach(json_decode($reserve->review->reviews,true) as $key=>$value)
                                                                                    <div class="col-12 pt-2 pb-2 px-0 row mx-0 mt-0">
                                                                                        <div class="col-3  text-dark small">{{ $key }}</div>
                                                                                        <div class="col-9 text-left  text-nowrap review-rating">
                                                                                            @for($i=0;$i<=$value;++$i)
                                                                                            <i class="fa fa-star position-relative text-warning-force" data-tooltip="2"></i>           
                                                                                            @endfor
                                                                                        </div>
                                                                                    </div>
                                                                                 @endforeach    

                                                                            </div>
                                                                             
                                                                        </div>

                                                                        <div class="col-12 mt-3">
                                                                            <p class="text-justify IR">{{ $reserve->review->content  }}</p>
                                                                        </div>
                                                                    @endif
                                                                
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if($reserve->review==null)
                                                                    <button type="submit"  title="ثبت" class="btn btn-primary px-8">ثبت</button>
                                                                    &nbsp;
                                                                    @endif
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </form>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
 
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $reserves->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
