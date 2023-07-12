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
                             <i class="fa fa-camera page-icon"></i>
                              ویدئو پزشک
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

                           
                                <form method="post" id="uploadform" action="{{ route('admin.doctors.upload',$doctor) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>آپلودویدئو</span>
                                                <input type="file" class="video" name="video" value="" accept="video/*">
                                                <div class="input-group-append">
                                                  <button class="btn btn-warning" type="submite">آپلود</button>
                                                </div>
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('video') }} </span>
                                        </div>
                                    </div>

                                </form>


                                <div class="row">
                                    <div class="progress" id="progress">
                                        <div class="bar" id="bar"></div >
                                        <div class="percent" id="percent">0%</div >
                                    </div>
                                </div>
  
                                <form method="post" action="{{ route('admin.doctors.video.store',$doctor) }}">
                                    @csrf    
                                    @method('patch')
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <input name="link" id="link" type="text"  placeholder="لینک" value="{{ $doctor->video }}" class="form-control text-right">
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <button type="submit" title="ثبت" class="btn btn-primary">ثبت</button>
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
