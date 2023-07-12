@extends('admin.master')


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
                            <ol class="breadcrumb m-0 IR">
                            {{ Breadcrumbs::render('reserves') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-first-order-alt page-icon"></i>
                             رزرها
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li class="IR">{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            
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
                                <div class="col-12 col-md-6 text-right"> 
                                    @if(Auth::guard('admin')->user()->can('reserves.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.reserves.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد رزرو جدید</b>
                                        </a>
                                    </div>
                                    @endif
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

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">کاربر</b></th>
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
                                            <td><strong class="IRANYekanRegular">{{ $reserve->user->firstname.' '.$reserve->user->lastname.' ('.$reserve->user->mobile.')' }}</strong></td>
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
                                                        @case(App\Enums\ReserveStatus::secratry)
                                                        <span class="badge badge-info IR p-1">ارجاع به منشی</span>
                                                        @break
                                                        @case(App\Enums\ReserveStatus::done)
                                                        <span class="badge badge-primary IR p-1">انجام شده</span>
                                                        @break
                                                    @endswitch
                                                </strong>
                                            </td>

                                            <td>
                                               
                                             @if(Auth::guard('admin')->user()->can('reserves.edit'))
                                              <a class="btn  btn-icon font-18" href="{{ route('admin.reserves.edit', $reserve) }}" title="ویرایش">
                                                <i class="fa fa-edit text-success"></i>
                                              </a>
                                              @endif

                                                        
                                              @if($reserve->review!=null && Auth::guard('admin')->user()->can('reserves.review'))
                                                <a class="btn  btn-icon font-18" href="#review{{ $reserve->id }}" data-toggle="modal" title="نظرسنجی">
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
                                                           
                                                                <div class="modal-body">
                                                                   
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
                                                                  
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                              @endif

                                               @if(Auth::guard('admin')->user()->can('rreserves.payment'))
                                                <a href="{{ route('admin.reserves.payment',$reserve) }}" class="btn btn-icon font-18" title="پرداخت">
                                                    <i class="fas fa-dollar-sign text-primary cusrsor"></i>
                                                </a>
                                               @endif

                                                @if(App\Enums\reserveStatus::done != $reserve->status && Auth::guard('admin')->user()->can('reserves.secratry') && $reserve->paid())
                                                <a class="btn  btn-icon font-18" href="#secratry{{ $reserve->id }}" data-toggle="modal" title="تعیین منشی">
                                                    <i class="fa fa-user text-dark cusrsor"></i>
                                                </a>

                                                <div class="modal fade" id="secratry{{ $reserve->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IR" id="newReviewLabel">تعیین منشی</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                           
                                                            <div class="modal-body">
                                                                
                                                                <form method="post" action="{{ route('admin.reserves.secratry',$reserve) }}" id="referForm">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="row">
                                                                        <select name="secratry" class="form-control select2   IRANYekanRegular"   data-placeholder="... منشی مورد نظر را انتخاب نمایید">
                                                                            <option value="" >...ارجاع به</option>
                                                                            @foreach($secretaries as $secretry)
                                                                                <option value="{{ $secretry->id }}"  {{ $secretry->id==$reserve->secratry_id?'selected':'' }}>{{ $secretry->fullname  }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </form>
            
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary mr-1" title="ثبت" form="referForm">ثبت</button>
                                                                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif


                                                @if(App\Enums\reserveStatus::done == $reserve->status || App\Enums\reserveStatus::secratry == $reserve->status )
                                                <a class="font-18" href="#asistant{{ $reserve->id }}" data-toggle="modal" title="تعیین وضعیت">
                                                    <i class="fas fa-thumbs-up  text-primary  cusrsor"></i>
                                                </a>

                                                <div class="modal fade" id="asistant{{ $reserve->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IR" id="newReviewLabel">تعیین وضعیت</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                           
                                                            <div class="modal-body">
                                                                
                                                                <form method="post" action="{{ route('admin.reserves.done',$reserve) }}" id="doneForm">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="row">
                                                                        <select name="asistant" class="form-control select2   IRANYekanRegular"   data-placeholder="...انجام دهنده کار را مشخص نمایید">
                                                                            <option value="" >...اجرا توسط</option>
                                                                            <optgroup label="پزشک">
                                                                                <option value="{{ $reserve->doctor_id }}" {{ $reserve->doctor_id==$reserve->asistant_id?'selected':'' }}>{{ $reserve->doctor->fullname ?? "" }}</option>
                                                                            </optgroup>

                                                                            <optgroup label="دستیار اول پزشک">
                                                                                @foreach($asistants as $asistant)
                                                                                    <option value="{{ $asistant->id }}"  {{ $asistant->id==$reserve->asistant_id?'selected':'' }}>{{ $asistant->fullname  }}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        </select>
                                                                    </div>
                                                                </form>
            
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary mr-1" title="ثبت" form="doneForm">ثبت</button>
                                                                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                @if(App\Enums\reserveStatus::done == $reserve->status )
                                                    <a class="btn  btn-icon font-18" href="{{ route('admin.reserves.upgrade.index', $reserve) }}" title="ارتقاء">
                                                        <i class="fas fa-level-up-alt text-success"></i>
                                                    </a>
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
