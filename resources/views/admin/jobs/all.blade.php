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
                               {{ Breadcrumbs::render('jobs') }} 
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fa fa-graduation-cap page-icon"></i>
                             مشاغل
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                        @if(Auth::guard('admin')->user()->can('jobs.create'))
                            <div class="btn-group" >
                                <a href="{{ route('admin.jobs.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus plusiconfont"></i>
                                    <b class="IRANYekanRegular">افزودن شغل جدید</b>
                                </a>
                            </div>
                        @endif
                            
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($jobs as $index=>$job)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $job->title }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @if($job->status == App\Enums\Status::Active)
                                                    <span class="badge badge-primary IR p-1">فعال</span>
                                                    @elseif($job->status == App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                    @endif
                                                </strong>
                                            </td>
                                            <td>

                                                @if($job->trashed())

                                                    @if(Auth::guard('admin')->user()->can('jobs.destroy'))
                                                    <a href="#recycle{{ $job->id }}" data-toggle="modal" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger font-18"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                    <div class="modal fade" id="recycle{{ $job->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title" id="newReviewLabel">بازیابی سطح</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular"> آیا مطمئن هستید که میخواهید شغل {{ $job->title }} را بازیابی نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.jobs.recycle', $job) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('patch')
                                                                        <button type="submit"  title="بازیابی" class="btn btn-info px-8">بازیابی</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif

                                                @else
                                                    
                                                    @if(Auth::guard('admin')->user()->can('jobs.edit'))
                                                    <a class="btn  btn-icon" href="{{ route('admin.jobs.edit',$job) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-info font-18"></i>
                                                    </a>
                                                     @endif
                                    
                                                    @if(Auth::guard('admin')->user()->can('jobs.destroy'))
                                                    <a href="#remove{{ $job->id }}" data-toggle="modal" class="btn btn-icon" title="حذف">
                                                        <i class="fa fa-trash text-danger font-18"></i>
                                                    </a>
                                            
                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $job->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف شغل</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید شغل {{ $job->title }} را حذف نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.jobs.destroy', $job) }}"  method="POST" class="d-inline">
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

                                                @endif
 
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
