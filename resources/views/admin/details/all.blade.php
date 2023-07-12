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
                                {{ Breadcrumbs::render('services.detiles') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fa fa-info page-icon"></i>
                              خدمات
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
                                    @if(Auth::guard('admin')->user()->can('services.details.create'))
                                    <div class="btn-group" >
                                        <a href="{{ route('admin.details.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">ایجاد خدمت جدید</b>
                                        </a>
                                    </div>
                                    @endif
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
                                            <th><b class="IRANYekanRegular">عنوان</b></th>
                                            <th><b class="IRANYekanRegular">قیمت</b></th>
                                            <th><b class="IRANYekanRegular">امتیاز معرف</b></th>
                                            <th><b class="IRANYekanRegular">امتیاز مشتری</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $row = 0;  @endphp
                                        @foreach($details as $detail)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$row }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $detail->name }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $detail->price }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $detail->porsant }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $detail->point }}</strong></td>
                                            <td>
                                                <strong class="IRANYekanRegular">
                                                    @if($detail->status == App\Enums\Status::Active)
                                                    <span class="badge badge-primary IR p-1">فعال</span>
                                                    @elseif($detail->status == App\Enums\Status::Deactive)
                                                    <span class="badge badge-danger IR p-1">غیرفعال</span>
                                                    @endif
                                                </strong>
                                            </td>
                                            <td>
                                                @if($detail->trashed())
                                                    @if(Auth::guard('admin')->user()->can('services.details.delete'))
                                                        <a class="font18 m-1" href="#recycle{{ $detail->id }}" data-toggle="modal" title="بازیابی">
                                                            <i class="fa fa-recycle text-danger"></i>
                                                        </a>

                                                        <!-- Recycle Modal -->
                                                        <div class="modal fade" id="recycle{{ $detail->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xs">
                                                                <div class="modal-content">
                                                                    <div class="modal-header py-3">
                                                                        <h5 class="modal-title IR" id="newReviewLabel">بازیابی سرویس</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <h5 class="IRANYekanRegular">آیا مطمئن هستید که می‌خواهید جزئیات  {{ $detail->name }} را بازیابی نمایید؟</h5>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('admin.details.recycle',$detail) }}" method="POST" class="d-inline">
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

                                                    @if(Auth::guard('admin')->user()->can('services.details.luck.create'))
                                                    <a class="font18 m-1" href="{{ route('admin.details.luck.create', $detail) }}" title="افزودن به گردونه شانس">
                                                        <i class="fas fa-hockey-puck text-success"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('services.details.images.show'))
                                                    <a class="font18 m-1" href="{{ route('admin.details.images.show', $detail) }}" title="تصاویر">
                                                        <i class="fas fa-images text-warning"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('services.details.videos.show'))
                                                    <a class="font18 m-1" href="{{ route('admin.details.videos.show', $detail) }}" title="ویدئوها">
                                                        <i class="fas fa-video text-primary"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('services.details.edit'))
                                                    <a class="font18 m-1" href="{{ route('admin.details.edit',$detail) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-info"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('services.details.delete'))
                                                    <a class="font18 mx-2" href="#remove{{ $detail->id }}" data-toggle="modal"  title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                    <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $detail->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف نظر</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید جزئیات {{ $detail->name }} را حذف کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.details.delete',$detail) }}"  method="POST" class="d-inline">
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
