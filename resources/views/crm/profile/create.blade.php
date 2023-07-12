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
                            <!-- {{ Breadcrumbs::render('article-add-cat') }} -->
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-suitcase page-icon"></i>
                             ایجاد نمونه کار جدید
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

                                <form class="form-horizontal" id="form" action="{{ route('admin.portfolios.store') }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان  را وارد کنید" value="{{ old('title')  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <label for="descriotion" class="control-label IRANYekanRegular">توضیحات</label>
                                            <textarea type="text" class="form-control input" name="descriotion" id="descriotion" placeholder="توضیحات  را وارد کنید">{{ old('descriotion')  }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('descriotion') }} </span>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر قبل</span>
                                                <input type="file" class="before" name="before" value="" accept="image/*">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('before') }} </span>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر بعد</span>
                                                <input type="file" class="after" name="after" value="" accept="image/*">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('after') }} </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>پوستر ویدئو</span>
                                                <input type="file" class="image" name="poster" value="" accept="image/*">
                                                <span class="form-text text-danger erroralarm"> {{ $errors->first('poster') }} </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="video" class="control-label IRANYekanRegular">لینک ویدئو</label>
                                            <input type="text" class="form-control input text-right" name="video" id="video" placeholder="لینک ویدئو را وارد کنید" value="{{ old('video')  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('video') }} </span>
                                        </div>
                                    </div>


                                </form>

                                <form method="post" id="uploadform" action="{{ route('admin.portfolios.upload') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>آپلود ویدئو</span>
                                                <input type="file" class="video" name="video" value="" accept="video/*">
                                                <div class="input-group-append">
                                                  <button class="btn btn-warning" type="submite">آپلود</button>
                                                </div>
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('video') }} </span>
                                        </div>
                                    </div>

                                </form>

                                <div class="row mt-2">
                                    <div class="progress" id="progress">
                                        <div class="bar" id="bar"></div >
                                        <div class="percent" id="percent">0%</div >
                                    </div>
                                </div>


                                <div class="row my-1">
                                    <div class="col-12" style="display:inherit;">
                                        <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" checked form="form">
                                        &nbsp;
                                        <label for="active">فعال</label><br>
                                        &nbsp;&nbsp; &nbsp;
                                        <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" form="form">
                                        &nbsp;
                                        <label for="deactive">غیرفعال</label><br>
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="submit"  value="ثبت" class="btn btn-primary" form="form">
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

        $(function()
        {
            $(document).ready(function()
            {
                var bar = $('.bar');
                var percent = $('.percent');

                $('#uploadform').ajaxForm({

                    beforeSend: function()
                    {
                        document.getElementById('progress').style.display = 'inline-flex';
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
                        document.getElementById('percent').style.color = '#fff';
                        document.getElementById('bar').style.background = '#95dd80';
                        var response = JSON.parse(xhr.responseText);
                        document.getElementById('video').value = response.url;
                    }
                });

            });

        });


</script>
@endsection
