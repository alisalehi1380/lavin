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
                            <ol class="breadcrumb m-0">
                            {{-- {{ Breadcrumbs::render('article-add-cat') }} --}}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fa fa-info page-icon"></i>
                              اطلاعات پزشک
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:auto">
                                   
                                <form class="form-horizontal" action="{{ route('admin.doctors.update',$doctor) }}" method="post" id="form">
                                    {{ csrf_field() }}
                                    @method('patch')
                                   
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="level" class="control-label IRANYekanRegular">تخصص</label>
                                                <input type="text" class="form-control input" name="speciality" id="speciality" placeholder="تخصص را وارد کنید" value="{{  $doctor->doctor->speciality ?? '' }}">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('speciality')  }} </span>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="code" class="col-form-label IRANYekanRegular">کد نظام پزشکی</label>
                                                <input type="text" class="form-control input text-right" name="code" id="code" placeholder="کد نظام پزشکی" value="{{  $doctor->doctor->code ?? '' }}">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('code')  }} </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label for="account" class="col-form-label IRANYekanRegular">تاریخ صدور</label>
                                                <input type="text"   class="form-control text-center" id="codeStartDate" name="codeStartDate" placeholder="تاریخ صدور" value="{{ $doctor->doctor!=null?$doctor->doctor->startDate():'' }}"  readonly>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('codeStartDate')   }} </span>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="expireDate" class="col-form-label IRANYekanRegular">تاریخ انقضاء</label>
                                                <input type="text"   class="form-control text-center" id="expireDate" name="expireDate" placeholder="تاریخ انقضاء" value="{{ $doctor->doctor!=null?$doctor->doctor->expireDate():'' }}" readonly>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('expireDate')  }} </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="desc" class="col-form-label IRANYekanRegular">توضیحات</label>
                                                <textarea  id="desc" name="desc" placeholder="توضیحات...">{{ $doctor->doctor->desc ?? '' }}</textarea>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('desc') }} </span>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <button type="submit" title="ثبت" class="btn btn-primary">ثبت</button>
                                            </div>
                                        </div>
                                </form>
                                
                                <div class="row">
                                    <div class="col-12  text-right">
                                        @if($doctor->doctor->video!=null)
                                        <video   width="320" height="240" controls>
                                            <source src="{{  $doctor->doctor->video }}">
                                        </video>
                                        @endif

                                        <a class="font18" href="{{ route('admin.doctors.video', $doctor->doctor) }}" title="ویدئو پزشک">
                                            <i class="fa fa-video text-warning"></i>
                                        </a>
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

@section('script')

    <script>

        $("#codeStartDate").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#codeStartDate",
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

        
        $("#expireDate").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#expireDate",
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

 
        $(function()
        {
            $(document).ready(function()
            {
                var bar = $('.bar');
                var percent = $('.percent');
                $('#uploadform').ajaxForm({

                    beforeSend: function()
                    {
                        var percentVal = '0%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    uploadProgress: function(event, position, total, percentComplete)
                    {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal)
                        percent.html(percentVal);
                    },
                    complete: function(xhr)
                    {
                        window.location.reload();
                    }
                });

            });

        });

</script>
@endsection
