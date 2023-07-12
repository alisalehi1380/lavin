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
                            {{ Breadcrumbs::render('services.detiles.luck',$detail) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-hockey-puck page-icon"></i>
                              افزودن به گردونه شانس
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form class="form-horizontal" id="form" action="{{ route('admin.details.luck.store',$detail) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">

                                    <div class="col-5">
                                        <label for="discount" class="control-label IRANYekanRegular">میزان تخفیف (%)</label>
                                        <input type="number" min="0" max="100" class="form-control input  text-center" name="discount" id="discount" placeholder="میزان تخفیف" value="{{ old('discount') }}">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('discount') }} </span>
                                    </div>

                                    <div class="col-5">
                                        <label for="probability" class="control-label IRANYekanRegular">حتمال برد (%)</label>
                                        <input type="number" min="0" max="100" class="form-control input  text-center" name="probability" id="probability" placeholder="احتمال برد" value="{{ old('probability') }}">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('probability') }} </span>
                                    </div>

                                    <div class="col-2 mt-4">
                                        <input type="submit"  value="ثبت" class="btn btn-primary">
                                    </div>

                                </div>
                            </form>

                         </div>
                    </div>
                </div>
             </div>
    </div>
</div>
@endsection

@section('script')

    <script>

        function reset()
        {
            document.getElementById('specialDateTime').value='';
        }


        $("#specialDateTime").MdPersianDateTimePicker({
            targetDateSelector: "#showDate_class",
            targetTextSelector: "#specialDateTime",
            textFormat: "yyyy/MM/dd HH:mm:ss",
            isGregorian: false,
            modalMode: false,
            englishNumber: false,
            enableTimePicker: true,
            selectedDateToShow: new Date(),
            calendarViewOnChange: function(param1){
            console.log(param1);
            }
        });


        //گرفتن  زیردسته های مربوطه توسط ایجکس
        function subcat(cat_id)
        {
            $.ajax({
                url: "{{ route('admin.shop.products.categories.fetch_child') }}",
                type: 'get',
                dataType: 'json',
                data:'cat_id='+cat_id,
                success: function(response)
                {
                    var len = 0;
                    $('#child_cat').empty();
                    if(response['childs'] != null){
                        len = response['childs'].length;
                    }

                    var tr_str ="<select class='form-control dropdopwn' name='child' id='child'>"+
                        "<option value='' class='dropdopwn'>دسته فرعی را انتخاب کنید...</option>";
                    for(var i=0; i<len; i++)
                    {
                        tr_str += "<option value='"+response['childs'][i].id+"' class='dropdopwn'>"+response['childs'][i].name+"</option>";
                    }
                    tr_str +="</select>";


                    $("#child_cat").append(tr_str);

                }
            });
        }

        $(function()
        {

            $(document).ready(function()
            {
                var bar = $('.bar');
                var percent = $('.percent');
                $('#form').ajaxForm({

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
