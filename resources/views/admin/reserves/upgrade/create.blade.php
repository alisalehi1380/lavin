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
                            {{ Breadcrumbs::render('reserves.upgrade.create',$reserve) }}
                            </ol>    
                        </div>
                        <h4 class="page-title">
                        <i class="fas fa-level-up-alt page-icon"></i>
                             ایجاد ارتقاء جدید
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

                                <form class="form-horizontal" action="{{ route('admin.reserves.upgrade.store',$reserve) }}" method="post">
                                   @csrf
                                    
                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                            <label for="service" class="control-label IRANYekanRegular">سرگروه سرویس</label>
                                            <select class="widht-100 form-control select2" name="service" id="service" onchange="details(this.value)">
                                                <option value="">سرگروه سرویس مورد نظر را انتخاب کنید...</option>
                                                @foreach($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('service') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12 col-md-6">
                                            <label for="detail" class="control-label IRANYekanRegular">سرویس</label>
                                            <div id="detail_div">
                                                <select class="widht-100 form-control" name="detail" id="detail">
                                                    <option value="">سرویس را انتخاب کنید...</option>
                                                </select>
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('detail') }} </span>
                                        </div>

                                        <div class="col-12 col-md-6">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="price" class="control-label IRANYekanRegular">مبلغ (تومان)</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="w-100 text-right seprate text-danger IR" id="show-pirce"></div>
                                                </div>
                                            </div>

                                            <input id="price" type="text" class="form-control text-right  @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autofocus placeholder="مبلغ" onkeyup="seprate(this.value,'show-price')">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('price') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">
                                        <div class="col-12">
                                            <label for="asistant2" class="control-label IRANYekanRegular">دستیار دوم</label>
                                            <select class="widht-100 form-control" name="asistant2" id="asistant2">
                                                <option value=""> دستیار دوم مورد نظر را انتخاب کنید...</option>
                                                    @foreach($asistants2 as $asistant)
                                                    <option value="{{ $asistant->id }}">{{ $asistant->fullname}}</option>
                                                    @endforeach
                                            </select>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('asistant2') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label for="desc" class="col-form-label text-md-right IRANYekanRegular">توضیحات:</label>
                                            <input id="desc" type="text" class="form-control  @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}"  autofocus placeholder="توضیحات">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('desc') }} </span>
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

                        var tr_str ="<select class='widht-100 form-control select2' name='detail' id='details'>"+
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

        function seprate(val , id)
        {
           
            if(val!='')
            {
                val = parseInt(val);
                if(typeof val === "number")
                {
                    var formatter = new Intl.NumberFormat('ar-EG');
                    var number = formatter.format(val);
                  
                    if(number=='٠')
                    {
                        document.getElementById("show-pirce").innerText = '';
                    }
                    else
                    {
                        document.getElementById("show-pirce").innerText = number;
                    }
                    
                }
              
            }
            else
            {
               
                document.getElementById("show-pirce").innerText = '';
            }
        }

        $(document).ready(function()
        {
            if($('#price').val()!='')
            {
                seprate(parseInt($('#price').val()), '#show-price');
            }
        })

        </script>
    @endsection

@endsection
