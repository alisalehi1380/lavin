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
                            {{ Breadcrumbs::render('services.detiles.videos',$detail) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-video page-icon"></i>
                            ویدئوهای سرویس
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

                                <form class="form-horizontal" id="form" action="{{ route('admin.details.videos.store',$detail) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان ویدئو</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان ویدئو را وارد کنید" value="{{ old('title')  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>ویدئو</span>
                                                <input type="file" class="video" name="video" value="" accept="video/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('video') }} </span>
                                        </div>

                                        <div class="col-6">
                                            <div class="fileupload btn btn-warning waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>پوستر ویدئو</span>
                                                <input type="file" class="image" name="poster" value="" accept="image/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('poster') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="progress">
                                            <div class="bar"></div >
                                            <div class="percent">0%</div >
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <input type="submit"  value="ثبت" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="row mt-5">

                                @foreach($videos as $video)
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <video  controls @if($video->poster!=null) poster="{{ $video->poster->getImagePath('original')  }}" @endif>
                                                <source src="{{ $video->getVideoPath() }}" type="video/mp4">
                                                <source src="{{ $video->getVideoPath() }}" type="video/ogg">
                                               <source src="{{ $video->getVideoPath() }}" type="video/mov">
                                                مرورگر شما این ویدئو را پوشش نمی دهد.
                                              </video>
                                            <div class="row m-1">
                                                <div class="col-6">
                                                    <h5 class="card-title IR">{{ $video->title }}</h5>
                                                </div>

                                                <div class="col-6 text-right">

                                                    <a href="#remove{{ $video->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                     <!-- Remove Modal -->
                                                     <div class="modal fade" id="remove{{ $video->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف ویدئو</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید ویدئو {{ $video->title }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.details.videos.delete',[$service,$detail,$video]) }}"  method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

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
