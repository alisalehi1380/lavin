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
                            {{ Breadcrumbs::render('ticket.departments') }}
                        </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-building page-icon"></i>
                              واحدها
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                             @if(Auth::guard('admin')->user()->can('departments.index'))
                            <div class="btn-group" >
                                <a href="{{ route('admin.departments.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus plusiconfont"></i>
                                    <b class="IRANYekanRegular">ایجاد واحد جدید</b>
                                </a>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">نام واحد</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($departments as $index=>$department)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $department->name }}</strong></td>
                                            <td>
                                                @if($department->status == App\Enums\Status::Deactive)
                                                 <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                @elseif($department->status == App\Enums\Status::Active)
                                                <span class="badge badge-primary IR p-1">فعال</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($department->trashed())
                                                
                                                     @if(Auth::guard('admin')->user()->can('departments.delete'))
                                                    <a href="#recycle{{ $department->id }}" data-toggle="modal" class="p-3" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger font-18"></i>
                                                    </a>
                                                    @endif
                                                @else
                                                    
                                                    @if(Auth::guard('admin')->user()->can('departments.edit'))
                                                    <a class="btn  btn-icon" href="{{ route('admin.departments.edit', $department) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-primary font-18"></i>
                                                    </a> 
                                                    @endif
                                                    
                                                    @if(Auth::guard('admin')->user()->can('departments.delete'))
                                                    <a href="#remove{{ $department->id }}" data-toggle="modal" class="btn btn-icon" title="حذف">
                                                        <i class="fa fa-trash text-danger font-18"></i>
                                                    </a>
                                             
                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $department->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف واحد</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید واحد  {{ $department->name }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.departments.delete', $department->id) }}"  method="POST" class="d-inline">
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