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
                            {{ Breadcrumbs::render('services.detiles.videos',$service,$detail) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-video page-icon"></i>
                            ویدئوهای خدمت
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                         <div class="row" style="margin-bottom: 20px;">
                                <div class="col-12">
                                    @if(Auth::guard('admin')->user()->can('services.details.videos.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.services.details.videos.create',[$service,$detail]) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد ویدئو جدید</b>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:auto">

                                <div class="row">

                                    @foreach($videos as $video)
                                        <div class="col-12 col-md-4">
                                            <div class="card">
                                                <video  height="250px" controls @if($video->poster!=null) poster="{{ $video->poster->getImagePath('original')  }}" @endif>
                                                    <source src="{{ $video->link }}" type="video/mp4">
                                                    <source src="{{ $video->link }}" type="video/ogg">
                                                <source src="{{ $video->link }}" type="video/mov">
                                                    مرورگر شما این ویدئو را پوشش نمی دهد.
                                                </video>
                                                <div class="row m-1">
                                                    <div class="col-6">
                                                        <h5 class="card-title IR">{{ $video->title }}</h5>
                                                    </div>

                                                    <div class="col-6 text-right">
                                                        @if(Auth::guard('admin')->user()->can('services.details.videos.delete'))
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
                                                                        <form action="{{ route('admin.services.details.videos.delete',[$service,$detail,$video]) }}"  method="POST" class="d-inline">
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
</div>
@endsection
 