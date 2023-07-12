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
                            {{ Breadcrumbs::render('article-add-cat') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-first-order-alt page-icon"></i>
                             ویرایش رزرو 
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

                                <form class="form-horizontal" action="{{ route('admin.reserves.update',$reserve) }}" method="post">
                                   @csrf
                                   @method('PATCH')
                                     
                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                        <label for="service" class="control-label IRANYekanRegular">سرویس</label>
                                            <select class="widht-100 form-control" name="service" id="service" onchange="details(this.value)">
                                                <option value="">سرویس مورد نظر را انتخاب کنید...</option>
                                                @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ $service->id == $reserve->service_id?'selected':'' }}>{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('service') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                        <label for="detail" class="control-label IRANYekanRegular">جزئیات سرویس</label>
                                            <div id="detail_div">
                                                <select class="widht-100 form-control" name="detail" id="detail">
                                                    <option value="">  جزئیات سوریس را انتخاب کنید...</option>
                                                    @foreach($details as $detail)
                                                    <option value="{{ $detail->id }}" {{ $detail->id == $reserve->detail_id?'selected':'' }}>{{ $detail->name }}</option>
                                                    @endforeach
                                                </select>
                                            <div>
                                        </div>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('detail') }} </span>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                        <label for="details" class="control-label IRANYekanRegular">پزشک</label>
                                            <div id="doctor_div">
                                                <select class="widht-100 form-control" name="doctor" id="doctor">
                                                    <option value=""> پزشک مورد نظر را انتخاب کنید...</option>
                                                    @foreach($doctors as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ $doctor->id == $reserve->doctor_id?'selected':'' }}>{{ $doctor->fullname }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('doctor') }} </span>
                                            <div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-12 col-md-6">
                                            <label for="account" class="col-form-label IRANYekanRegular">وضعیت</label>
                                             <select name="status" id="st" class="form-control dropdown IR">
                                                <option value="{{ App\Enums\ReserveStatus::waiting }}" {{ $reserve->status==App\Enums\ReserveStatus::waiting?'selected':'' }}>درانتظار</option>
                                                <option value="{{ App\Enums\ReserveStatus::confirm }}" {{ $reserve->status==App\Enums\ReserveStatus::confirm?'selected':'' }}>تایید</option>
                                                <option value="{{ App\Enums\ReserveStatus::cancel }}"  {{ $reserve->status==App\Enums\ReserveStatus::cancel?'selected':'' }}>لغو</option>
                                                <option value="{{ App\Enums\ReserveStatus::done }}"    {{ $reserve->status==App\Enums\ReserveStatus::done?'selected':'' }}>انجام شده</option> 
                                             </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                        </div>

                                        <div class="form-group col-12 col-md-6">
                                            <label for="account" class="col-form-label IRANYekanRegular">نوبت</label>
                                            <input type="text"   class="form-control text-center" id="time" name="time"  readonly value="{{  $reserve->time!=null?$reserve->round_time2():'' }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('time') }} </span>
                                        </div>

                                    </div>
 
                                 
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success">بروزرسانی</button>
                                        </div>
                                    </div>
                                    
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


    @section('script')
        <script type="text/javascript">
       
  
        function details(id)
        {
            
            $.ajax({
               type:'GET',
               url: "{{ route('admin.detailsfetch') }}",
               data:'service='+id+'&&_token = <?php echo csrf_token() ?>',
               success:function(response) {
               
                    var len = 0;
                    $('#detail_div').empty();
                    if(response['details'] != null)
                    {
                        len = response['details'].length;
                    }

                    var tr_str ="<select class='widht-100 form-control select2' name='detail' id='details' onchange='doctors(this.value)'>"+
                    "<option value=''>  جزئیات سوریس را انتخاب کنید...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['details'][i].id+"' class='dropdopwn'>"+response['details'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#detail_div").append(tr_str);
                }
           });
        }
       
        
        function doctors(id)
        {
            $.ajax({
               type:'GET',
               url: "{{ route('admin.doctorsfetch') }}",
               data:'service='+id+'&&_token = <?php echo csrf_token() ?>',
               success:function(response) {
            
                 var len = 0;
                $('#doctor_div').empty();
                if(response['doctors'] != null)
                {
                    len = response['doctors'].length;
                }

                var tr_str ="<select class='widht-100 form-control select2' name='doctor' id='doctor'>";
                for(var i=0; i<len; i++)
                {
                    tr_str += "<option value='"+response['doctors'][i].id+"' class='dropdopwn'>"+response['doctors'][i].name+"</option>";
                }
                tr_str +="</select>";


                $("#doctor_div").append(tr_str);
                
                 
               }
            });
        }
        
        
        $("#time").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#time",
            textFormat: "yyyy/MM/dd HH:mm",
            isGregorian: false,
            modalMode: false,
            englishNumber: true,
            enableTimePicker: true,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });
   
                                
        </script>
    @endsection

@endsection
