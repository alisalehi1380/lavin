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
                            {{ Breadcrumbs::render('reserves.create') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-first-order-alt page-icon"></i>
                             ایجاد رزرو جدید
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

                                <form class="form-horizontal" action="{{ route('admin.reserves.store') }}" method="post">
                                   @csrf

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                        <label for="user" class="control-label IRANYekanRegular">کاربر</label>
                                            <select class="widht-100 form-control select2" name="user" id="user"></select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('user') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                            <label for="service" class="control-label IRANYekanRegular">سرویس</label>
                                            <select class="widht-100 form-control select2" name="service" id="service" onchange="details(this.value)">
                                                <option value="">سرویس مورد نظر را انتخاب کنید...</option>
                                                @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('service') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                            <label for="detail" class="control-label IRANYekanRegular">جزئیات سرویس</label>
                                            <div id="detail_div">
                                                <select class="widht-100 form-control select2" name="detail" id="detail">
                                                    <option value="">  جزئیات سوریس را انتخاب کنید...</option>
                                                </select>
                                            </div>
                                        </div>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('detail') }} </span>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                            <label for="details" class="control-label IRANYekanRegular">پزشک</label>
                                            <div id="doctor_div">
                                                <select class="widht-100 form-control select2" name="doctor" id="doctor">
                                                    <option value=""> پزشک مورد نظر را انتخاب کنید...</option>
                                                </select>
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('doctor') }} </span>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">ثبت</button>
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
         $("#user").select2({

            placeholder: '... نام و نام خانوادگی یا شماره موبایل یا شماره ملی',
            ajax: {
                url: '{{ route("admin.users.fetch") }}',

                processResults: function (data) {
                    let res = [];


                    $.each(data.data, function (index, item) {
                        res.push({
                            'id': item.id,
                            'text': item.name
                        });
                    });


                    return {
                        results: res
                    };
                }
            }
        });



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
                     
                    var tr_str ="<select class='widht-100 form-control select2' name='detail' id='detail' onchange='doctors(this.value)'>"+
                    "<option value=''>  جزئیات سرویس را انتخاب کنید...</option>";
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



        </script>
    @endsection

@endsection
