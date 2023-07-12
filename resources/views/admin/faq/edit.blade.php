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
                           {{ Breadcrumbs::render("faq.edit",$faq) }}  
                            </ol>
                        </div>
                        <h4 class="page-title">
                        <i class="fas fa-question"></i>
                           ویرایش پرسش و پاسخ
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

                                <form class="form-horizontal" id="form" action="{{ route('admin.faq.update',$faq) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                      @method('patch')

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="question" class="control-label IRANYekanRegular">پرسش</label>
                                            <input type="text" class="form-control input" name="question" id="question" placeholder="پرسش  را وارد کنید" value="{{ old('question') ?? $faq->question  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('question') }} </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <label for="answer" class="control-label IRANYekanRegular">پاسخ</label>
                                            <textarea type="text" class="form-control input" name="answer" id="answer" placeholder="پاسخ  را وارد کنید">{{ old('answer') ?? $faq->answer  }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('answer') }} </span>
                                        </div>
                                    </div>

                                    <div class="row mt-2 ">
                                        <div class="col-12" style="display:inherit;">
                                            <input type="radio" id="active" name="display" value="{{ App\Enums\Status::Active }}" @if($faq->display!=App\Enums\Status::Deactive  ) checked @endif>
                                            &nbsp;
                                            <label for="active">نمایش</label><br>
                                            &nbsp;&nbsp; &nbsp;
                                            <input type="radio" id="deactive" name="display" value="{{ App\Enums\Status::Deactive }}" @if($faq->display==App\Enums\Status::Deactive) checked @endif>
                                            &nbsp;
                                            <label for="deactive">عدم نمایش</label><br>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <input type="submit"  value="بروزرسانی" class="btn btn-success" title="بروزرسانی">
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
