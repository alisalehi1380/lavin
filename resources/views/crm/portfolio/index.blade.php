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
                            {{-- {{ Breadcrumbs::render('article-categories') }} --}}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-suitcase page-icon"></i>
                             نمونه کارها
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="btn-group" >
                                    <a href="{{ route('admin.portfolios.create') }}" class="btn btn-sm btn-primary" title="نمونه کار جدید">
                                        <i class="fa fa-plus plusiconfont"></i>
                                        <b class="IRANYekanRegular">ایجاد نمونه کار جدید</b>
                                    </a>
                                </div>
                            </div>

                            <div class="row mt-2">

                                    <div class="col-12">
                                        <div class="accordion mb-3" id="accordionExample">

                                            @foreach($portfolios as $portfolio)
                                                <div class="card mb-1">
                                                    <div class="card-header pointer" id="heading{{ $portfolio->id }}" data-toggle="collapse" href="#collapse{{ $portfolio->id }}" aria-expanded="true" aria-controls="collapse{{ $portfolio->id }}">
                                                        <h5 class="my-0">
                                                            <a class="text-primary IR" data-toggle="collapse" href="#collapse{{ $portfolio->id }}" aria-expanded="true" aria-controls="collapse{{ $portfolio->id }}">
                                                                # {{ $portfolio->title }}
                                                            </a>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse{{ $portfolio->id }}" class="collapse" aria-labelledby="heading{{ $portfolio->id }}" data-parent="#accordionExample">
                                                        <div class="card-body" style="min-height: 200px;">
                                                            <div class="row">

                                                                <div class="col-4">
                                                                    @if($portfolio->before!=null)
                                                                    <h5 class="IR">تصویر قبل</h5>
                                                                    <a href="{{ $portfolio->before_img->getImagePath('medium') }}" target="_blanck">
                                                                       <img class="card-img-top img-fluid" src="{{ $portfolio->before_img->getImagePath('medium') }}" alt="{{ $portfolio->before_img->alt }}" title="{{ $portfolio->before_img->title }}"> 
                                                                    </a>
                                                                    @endif
                                                                </div>

                                                                <div class="col-4">
                                                                    @if($portfolio->after!=null)
                                                                    <h5 class="IR">تصویر بعد</h5>
                                                                    <a href="{{ $portfolio->after_img->getImagePath('medium') }}" target="_blanck">
                                                                       <img class="card-img-top img-fluid" src="{{ $portfolio->after_img->getImagePath('medium') }}" alt="{{ $portfolio->after_img->alt }}" title="{{ $portfolio->after_img->title }}"> 
                                                                    </a>
                                                                    @endif
                                                                </div>

                                                                <div class="col-4 text-center">
                                                                    @if($portfolio->video!=null)
                                                                    <h5 class="IR">ویدئو</h5>
                                                                    <video  height="250px" controls @if($portfolio->poster_img!=null) poster="{{ $portfolio->poster_img->getImagePath('original')  }}" @endif>
                                                                        <source src="{{ $portfolio->video }}" type="video/mp4">
                                                                        <source src="{{ $portfolio->video }}" type="video/ogg">
                                                                        <source src="{{ $portfolio->video }}" type="video/mov">
                                                                        مرورگر شما این ویدئو را پوشش نمی دهد.
                                                                    </video>
                                                                    @endif
                                                                </div>

                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-12">
                                                                     <p class="IRANYekanRegular text-justify">{{ $portfolio->descriotion }}</p> 
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-6">
                                                                    <strong class="IRANYekanRegular">
                                                                        @if($portfolio->status == App\Enums\Status::Active)
                                                                        <span class="badge badge-primary IR p-1">فعال</span>
                                                                        @elseif($portfolio->status == App\Enums\Status::Deactive)
                                                                        <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                                        @endif
                                                                    </strong>
                                                                </div>
                                                                <div class="col-6 text-right">
                                                                    <a class="font18 m-1" href="{{ route('admin.portfolios.edit', $portfolio) }}" title="ویرایش">
                                                                        <i class="fa fa-edit text-info"></i>
                                                                    </a>
                
                                                                    <a href="#remove{{ $portfolio->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                                        <i class="fa fa-trash text-danger"></i>
                                                                    </a>
                
                                                                    <!-- Remove Modal -->
                                                                    <div class="modal fade" id="remove{{ $portfolio->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header py-3">
                                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف سرویس</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید نمونه کار {{ $portfolio->title }} را حذف کنید؟</h5>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <form action="{{ route('admin.portfolios.delete', $portfolio) }}"  method="POST" class="d-inline">
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
    </div>

@endsection
