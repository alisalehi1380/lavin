@extends('admin.master')


@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    {{ Breadcrumbs::render('dashboard') }}
                                </ol>
                            </div>
                            <h4 class="page-title">داشبورد</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 

                <div class="row">
                    <div class="m-2">
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                            <i class="fas fa-filter"></i>
                        </button>
                    </div>
                </div>

                <div class="collapse" id="filter">
                    <div class="card card-body filter">
                        <form id="filter-form">
                            <div class="row">                                
                                <div class="form-group justify-content-center col-6">
                                    <label for="levels" class="control-label IRANYekanRegular">سطح کاربر</label>
                                        <select name="levels[]" id="levels-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... سطوح مورد نظر را انتخاب نمایید">
                                        @foreach($levels as $level)
                                        <option value="{{ $level->id }}" @if(request('levels')!=null) {{ in_array($level->id,request('levels'))?'selected':'' }} @endif>{{ $level->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                                            
                                <div class="form-group justify-content-center col-6">
                                    <label for="doctors" class="control-label IRANYekanRegular">پزشک</label>
                                        <select name="doctors[]" id="doctors-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... پزشکان مورد نظر را انتخاب نمایید">
                                        @foreach($doctorsList as $doctor)
                                        <option value="{{ $doctor->id }}" @if(request('doctors')!=null) {{ in_array($doctor->id,request('doctors'))?'selected':'' }} @endif>{{ $doctor->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>

                           </div>
                           

                            <div class="row">
                                <div class="form-group justify-content-center col-6">
                                    <label for="since" class="col-form-label IRANYekanRegular">از تاریخ</label>
                                    <input type="text"   class="form-control text-center" id="since" name="since"  readonly value="{{ request('since') }}">
                                </div>

                                <div class="form-group justify-content-center col-6">
                                    <label for="until" class="col-form-label IRANYekanRegular">تا تاریخ</label>
                                    <input type="text"   class="form-control text-center" id="until" name="until"  readonly value="{{ request('until') }}">
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
                                        document.getElementById("name-filter").value = "";
                                        document.getElementById("code-filter").value = "";
                                        document.getElementById("ref-filter").value = "";
                                        document.getElementById("since").value = "";
                                        document.getElementById("until").value = "";
                                        document.getElementById("state_id-filter").selectedIndex = "0";
                                        document.getElementById("club_id-filter").selectedIndex = "0";
                                        document.getElementById("provider_id-filter").selectedIndex = "0";
                                        document.getElementById("status-filter").selectedIndex = "0";
                                        document.getElementById("delivery-filter").selectedIndex = "0";
                                    }
                                </script>

                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">

                     <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعدادرزرو</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($reserves) }}</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
                            <h4 class="mt-0 font-16 IRANYekanRegular">مبلغ کل رزرو (تومان)</h4>
                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{  number_format($reservesSum) }}</h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعداد فروش محصول</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($orders) }}</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                            <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="More Info"></i>
                            <h4 class="mt-0 font-16 IRANYekanRegular">کل فروش محصول (تومان)</h4>
                            <h2 class="text-primary my-3 text-center"><span data-plugin="counterup">{{  number_format($ordersSum) }}</h2>
                        </div>
                    </div>

                   
                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعداد کاربران</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($users) }}</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعداد پزشکان</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($doctors) }}</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعداد تیکت ها</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($tickets) }}</span></h2>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="card-box">
                        <a href="" class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="نمایش" data-original-title="نمایش"></a>
                            <h4 class="mt-0 font-16 IRANYekanRegular">تعداد بازخوردها</h4>
                            <h2 class="text-primary my-3 text-center IR"><span data-plugin="counterup">{{  number_format($reviews) }}</span></h2>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('script')

        <script type="text/javascript">
        $("#since").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#since",
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

        $("#until").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#until",
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
