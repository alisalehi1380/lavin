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
                              {{ Breadcrumbs::render('services') }} 
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fab fa-servicestack page-icon"></i>
                              سرگروه خدمات
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
                               
                                <div class="col-6">
                                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="collapseExample" title="فیلتر">
                                        <i class="fas fa-filter"></i>
                                    </button>
                                </div>

                                <div class="col-6 text-right">
                                    <div class="btn-group" >
                                       @if(Auth::guard('admin')->user()->can('services.create'))
                                        <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد‌ سرگروه جدید</b>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">

                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">عنوان دسته بندی</label>
                                                <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="عنوان را وارد کنید" value="{{ request('name') }}">
                                            </div>

                                        </diV>

                                        <div class="form-group col-12 d-flex justify-content-center mt-3">

                                            <button type="submit" class="btn btn-info col-lg-2 offset-lg-4 cursor-pointer">
                                                <i class="fa fa-filter fa-sm"></i>
                                                <span class="pr-2">فیلتر</span>
                                            </button>

                                            <div class="col-lg-2">
                                                <a onclick="reset()" class="btn btn-light border border-secondary cursor-pointer">
                                                    <i class="fas fa-undo fa-sm"></i>
                                                    <span class="pr-2">پاک کردن</span>
                                                </a>
                                            </div>


                                            <script>
                                                function reset()
                                                {
                                                    document.getElementById("name-filter").value = "";
                                                }
                                            </script>

                                        </div>
                                    </form>
                                </div>
                            </div>
                           
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><b class="IRANYekanRegular">ردیف</b></th>
                                            <th><b class="IRANYekanRegular">نام سرگروه</b></th>
                                            <th><b class="IRANYekanRegular">دسته اصلی</b></th>
                                            <th><b class="IRANYekanRegular">دسته فرعی</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($allservices as $index=>$service)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $service->name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $service->parent_cat->name ?? '' }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $service->child_cat->name ?? '' }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @if($service->status == App\Enums\Status::Active)
                                                    <span class="badge badge-primary IR p-1">فعال</span>
                                                    @elseif($service->status == App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                    @endif
                                                </strong>
                                            </td>
                                            <td>
                                                @if($service->trashed())
                                                    @if(Auth::guard('admin')->user()->can('services.delete'))
                                                    <a class="font18 m-1" href="#recycle{{ $service->id }}" data-toggle="modal" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                    <div class="modal fade" id="recycle{{ $service->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IR" id="newReviewLabel">بازیابی سرویس</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید سرویس  {{ $service->name }} را بازیابی نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.services.recycle', $service) }}" method="POST" class="d-inline">
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
 
                                                    @if(Auth::guard('admin')->user()->can('services.edit'))
                                                    <a class="font18 m-1" href="{{ route('admin.services.edit', $service) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-info"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('services.delete'))
                                                    <a href="#remove{{ $service->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $service->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف سرویس</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید سرویس {{ $service->name }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.services.delete', $service) }}"  method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger px-8" title="حذف" >حذف</button>
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
