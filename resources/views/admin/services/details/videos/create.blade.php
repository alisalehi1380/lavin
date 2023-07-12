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
                            {{ Breadcrumbs::render('services.detiles.videos.create',$service,$detail) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-video page-icon"></i>
                             ایجاد ویدئو جدید
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

                                <form class="form-horizontal" id="form" action="{{ route('admin.services.details.videos.store',[$service,$detail]) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان ویدئو</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان ویدئو را وارد کنید" value="{{ old('title')  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>پوستر ویدئو</span>
                                                <input type="file" class="image" name="poster" value="" accept="image/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('poster') }} </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="link" class="control-label IRANYekanRegular">لینک ویدئو</label>
                                            <input type="text" class="form-control input text-right" name="link" id="link" placeholder="لینک ویدئو را وارد کنید" value="{{ old('link')  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('link') }} </span>
                                        </div>
                                    </div>

                                </form>  

                                <form method="post" id="uploadform" action="{{ route('admin.services.details.videos.upload',[$service,$detail]) }}" enctype="multipart/form-data">
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
                        document.getElementById('link').value = response.url;
                    }
                });

            });

        });


</script>
@endsection
