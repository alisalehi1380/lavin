@extends('admin.master')

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
                           {{ Breadcrumbs::render('messages') }}
                        </ol>
                    </div>
                    <h4 class="page-title">
                         <i class="fas fa-envelope-square page-icon"></i>
                         پیام ها
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
                                    <div class="row" style="margin-bottom: 20px;">
                                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="user" class="control-label IRANYekanRegular">کاربر</label>
                                                <input type="text"  class="form-control input" id="user-filter" name="user" placeholder=" نام و نام خانوادگی یا شماره موبایل کاربر را وارد نمایید..." value="{{ request('user') }}">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label for="seen" class="control-label IRANYekanRegular">وضعیت</label>
                                                <select name="seen[]" id="seen-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="...وضعیت را انتخاب نمایید">
                                                    <option value="{{ App\Enums\seenStatus::seen }}" @if(request('seen')!=null) {{ in_array(App\Enums\seenStatus::seen,request('seen'))?'selected':'' }} @endif>خوانده شده</option>
                                                    <option value="{{ App\Enums\seenStatus::unseen }}" @if(request('seen')!=null) {{ in_array(App\Enums\seenStatus::unseen,request('seen'))?'selected':'' }} @endif>خوانده نشده</option>
                                                </select>
                                            </div>
                                        </diV>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="since-filter" class="col-form-label IRANYekanRegular">از تاریخ </label>
                                                <input type="text"   class="form-control text-center" id="since-filter" name="since"  readonly value="{{ request('since') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="until-filter" class="col-form-label IRANYekanRegular">تا تاریخ </label>
                                                <input type="text"   class="form-control text-center" id="until-filter" name="until"  readonly value="{{ request('until') }}">
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
                                                    document.getElementById("title-filter").value = "";
                                                    document.getElementById("since-filter").value = "";
                                                    document.getElementById("until-filter").value = "";
                                                    $("#seen-filter").val(null).trigger("change");
                                                }
                                            </script>

                                        </div>
                                    </form>
                                </div>
                            </div>

 
                            @foreach($messages as $index=>$message)

                                <div class="card-box">

                                    <div class="row">
                                        <div class="col-12">
                                            <strong class="IR">
                                               <span class="text-muted">نام و نام خانوادگی:</span>
                                               {{  $message->fullname ?? 'ناشناس'  }}
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <strong class="IR">
                                               <span class="text-muted">تلفن همراه:</span>
                                               {{  $message->mobile ?? ''  }}
                                            </strong>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            <strong class="IR">
                                               <span class="text-muted">تاریخ درج:</span>
                                               {{ $message->created_at() }}
                                            </strong>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mt-2">
                                            @if($message->seen==App\Enums\seenStatus::unseen)
                                            <span class="badge badge-danger IR  p-1">خوانده نشده</span>
                                            @elseif($message->seen==App\Enums\seenStatus::seen)
                                            <span class="badge badge-primary IR  p-1">خوانده شده</span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-12 text-right">
                                       
                                        <a  href="{{ route('admin.messages.show', $message) }}" title="نمایش">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                           
                                     </div>

                                </div>

                            @endforeach

                            {!! $messages->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')

   <script type="text/javascript">
        $("#since-filter").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#since-filter",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });

        $("#until-filter").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#until-filter",
            textFormat: "yyyy/MM/dd",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: false,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });

  


    </script>
@endsection
