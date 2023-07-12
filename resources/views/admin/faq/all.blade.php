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
                            
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-question"></i>
                            سئوالات متداول
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
                                @if(Auth::guard('admin')->user()->can('faq.create'))
                                <div class="btn-group" >
                                    <a href="{{ route('admin.faq.create') }}" class="btn btn-sm btn-primary" title="پرسش و پاسخ">
                                        <i class="fa fa-plus plusiconfont"></i>
                                        <b class="IRANYekanRegular">ایجاد پرسش و پاسخ جدید</b>
                                    </a>
                                </div>
                                @endif
                            </div>

                            <div class="row mt-2">

                                    <div class="col-12">
                                        <div class="accordion mb-3" id="accordionExample">

                                            @foreach($faqs as $faq)
                                                <div class="card mb-1">
                                                    <div class="card-header pointer" id="heading{{ $faq->id }}" data-toggle="collapse" href="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                        <h5 class="my-0">
                                                            <a class="text-primary IR" data-toggle="collapse" href="#collapse{{ $faq->id }}" aria-expanded="true" aria-controls="collapse{{ $faq->id }}">
                                                                # {{ $faq->question }}
                                                            </a>
                                                        </h2>
                                                    </div>

                                                    <div id="collapse{{ $faq->id }}" class="collapse" aria-labelledby="heading{{ $faq->id }}" data-parent="#accordionExample">
                                                        <div class="card-body" style="min-height: 200px;">
               
                                                            <div class="row mt-2">
                                                                <div class="col-12">
                                                                     <p class="IRANYekanRegular text-justify">{{ $faq->answer }}</p> 
                                                                </div>
                                                            </div>

                                                            <div class="row mt-2">
                                                                <div class="col-6">
                                                                    <strong class="IRANYekanRegular">
                                                                        @if($faq->display)
                                                                        <span class="badge badge-primary IR p-1">نمایش</span>
                                                                        @else
                                                                        <span class="badge badge-danger IR p-1">عدم نمایش</span>
                                                                        @endif
                                                                    </strong>
                                                                </div>
                                                                <div class="col-6 text-right">
                                                                     @if(Auth::guard('admin')->user()->can('faq.edit'))
                                                                    <a class="font18 m-1" href="{{ route('admin.faq.edit', $faq) }}" title="ویرایش">
                                                                        <i class="fa fa-edit text-info"></i>
                                                                    </a>
                                                                    @endif

                                                                    @if(Auth::guard('admin')->user()->can('faq.destroy'))
                                                                    <a href="#remove{{ $faq->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                                        <i class="fa fa-trash text-danger"></i>
                                                                    </a>
                
                                                                    <!-- Remove Modal -->
                                                                    <div class="modal fade" id="remove{{ $faq->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-xs">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header py-3">
                                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف سرویس</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body text-center">
                                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید این پرسش و پاسخ را حذف کنید؟</h5>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <form action="{{ route('admin.faq.destroy', $faq ) }}"  method="POST" class="d-inline">
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
