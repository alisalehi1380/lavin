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
                               {{ Breadcrumbs::render('portfolios.edit',$portfolio) }} 
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-suitcase page-icon"></i>
                            ویرایش نمونه کار                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:auto">

                                <form class="form-horizontal" id="form" action="{{ route('admin.portfolios.update',$portfolio) }}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="title" class="control-label IRANYekanRegular">عنوان</label>
                                            <input type="text" class="form-control input" name="title" id="title" placeholder="عنوان  را وارد کنید" value="{{ old('title') ?? $portfolio->title  }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('title') }} </span>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-12">
                                            <label for="descriotion" class="control-label IRANYekanRegular">توضیحات</label>
                                            <textarea type="text" class="form-control input" name="descriotion" id="descriotion" placeholder="توضیحات  را وارد کنید">{{ old('descriotion') ?? $portfolio->descriotion   }}</textarea>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('descriotion') }} </span>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر قبل</span>
                                                <input type="file" class="before" name="before" value="" accept="image/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('before') }} </span>
                                        </div>
                                        <div class="col-6">
                                            @if($portfolio->before_img!=null)
                                            <a href="#removebefore" data-toggle="modal" class="font18 m-1" title="حذف">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                            <img class="card-img-top img-fluid" src="{{ $portfolio->before_img->getImagePath('medium') }}" alt="{{ $portfolio->before_img->alt }}" title="{{ $portfolio->before_img->title }}"> 
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>تصویر بعد</span>
                                                <input type="file" class="after" name="after" value="" accept="image/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('after') }} </span>
                                        </div>

                                        <div class="col-6">
                                            @if($portfolio->after_img!=null)
                                            @if(Auth::guard('admin')->user()->can('portfolios.remove_image'))
                                            <a href="#removeafter" data-toggle="modal" class="font18 m-1" title="حذف">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                            @endif
                                            <img class="card-img-top img-fluid" src="{{ $portfolio->after_img->getImagePath('medium') }}" alt="{{ $portfolio->after_img->alt }}" title="{{ $portfolio->after_img->title }}"> 
                                            @endif
                                        </div>

                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <div class="fileupload btn btn-success waves-effect waves-light m-4">
                                                <span><i class="mdi mdi-cloud-upload mr-1"></i>پوستر ویدئو</span>
                                                <input type="file" class="image" name="poster" value="" accept="image/*">
                                            </div>
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('poster') }} </span>
                                        </div>

                                        <div class="col-6">
                                            @if($portfolio->poster_img!=null)
                                            @if(Auth::guard('admin')->user()->can('portfolios.remove_image'))
                                            <a href="#removeposter" data-toggle="modal" class="font18 m-1" title="حذف">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                            @endif
                                            <img class="card-img-top img-fluid" src="{{ $portfolio->poster_img->getImagePath('medium') }}" alt="{{ $portfolio->poster_img->alt }}" title="{{ $portfolio->poster_img->title }}"> 
                                            @endif
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <label for="video" class="control-label IRANYekanRegular">لینک ویدئو</label>
                                            <input type="text" class="form-control input text-right" name="video" id="video" placeholder="لینک ویدئو را وارد کنید" value="{{ old('video') ?? $portfolio->video   }}">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('video') }} </span>
                                        </div>
                                    </div>

                                </form>

                                @if(Auth::guard('admin')->user()->can('portfolios.upload'))
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
                                @endif


                                <div class="row my-1">
                                    <div class="col-12" style="display:inherit;">
                                        <input type="radio" id="active" name="status" value="{{ App\Enums\Status::Active }}" @if(old('status')==App\Enums\Status::Active || $portfolio->status==App\Enums\Status::Active) checked @endif form="form">
                                        &nbsp;
                                        <label for="active">فعال</label><br>
                                        &nbsp;&nbsp; &nbsp;
                                        <input type="radio" id="deactive" name="status" value="{{ App\Enums\Status::Deactive }}" @if(old('status')==App\Enums\Status::Deactive || $portfolio->status==App\Enums\Status::Deactive) checked @endif form="form">
                                        &nbsp;
                                        <label for="deactive">غیرفعال</label><br>
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-12">
                                        <input type="submit"  value="بروزرسانی" class="btn btn-success" form="form">
                                    </div>
                                </div>


                            </div>


                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

 
@if($portfolio->before_img!=null)
<!-- Remove Befor Modal -->
<div class="modal fade" id="removebefore" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف تصویر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این تصویر را حذف کنید؟</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.portfolios.remove_image',$portfolio->before_img) }}"  method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                </form>
                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>
</div>
@endif

@if($portfolio->after_img!=null)
<!-- Remove After Modal -->
<div class="modal fade" id="removeafter" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف تصویر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این تصویر را حذف کنید؟</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.portfolios.remove_image',$portfolio->after_img) }}"  method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                </form>
                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>
</div>
@endif

@if($portfolio->poster_img!=null)
<!-- Remove Poster Modal -->
<div class="modal fade" id="removeposter" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header py-3">
                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف تصویر</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این تصویر را حذف کنید؟</h5>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.portfolios.remove_image',$portfolio->poster_img) }}"  method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                </form>
                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>
</div>
@endif
 

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
