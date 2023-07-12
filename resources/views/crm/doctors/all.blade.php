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
                            {{ Breadcrumbs::render('admins') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-users page-icon"></i>
                                ادمین ها
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
                                    {{-- @if(Auth::guard('admin')->user()->can('add-admin')) --}}
                                    <div class="btn-group">
                                        <a href="{{ route('admin.admins.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">افزودن ادمین جدید</b>
                                        </a>
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>

                            
                            <div class="collapse" id="filter">
                                <div class="card card-body filter">
                                    <form id="filter-form">
                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="fullname" class="control-label IRANYekanRegular">نام و نام خانوادگی</label>
                                                <input type="text"  class="form-control input" id="fullname-filter" name="fullname" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ request('fullname') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="nationalcode" class="control-label IRANYekanRegular">شماره ملی</label>
                                                <input type="text"  class="form-control input" id="nationalcode-filter" name="nationalcode" placeholder="شماره ملی را وارد کنید" value="{{ request('nationalcode') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="email" class="control-label IRANYekanRegular">آدرس ایمیل</label>
                                                <input type="text"  class="form-control input" id="email-filter" name="email" placeholder="آدرس ایمیل را وارد کنید" value="{{ request('email') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="mobile" class="control-label IRANYekanRegular">موبایل</label>
                                                <input type="text"  class="form-control input" id="mobile-filter" name="mobile" placeholder="شماره موبایل را وارد کنید" value="{{ request('mobile') }}">
                                            </div>
                              

                                            <div class="form-group justify-content-center col-6">
                                                <label for="status" class="control-label IRANYekanRegular">وضعیت</label>
                                                 <select name="status[]" id="status-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... وضعیت های مورد نظر را انتخاب نمایید"> 
                                                    <option value="{{ App\Enums\Status::Active }}" @if(request('status')!=null) {{ in_array(App\Enums\Status::Active,request('status'))?'selected':'' }} @endif>فعال</option>
                                                    <option value="{{ App\Enums\Status::Deactive }}" @if(request('status')!=null) {{ in_array(App\Enums\Status::Deactive,request('status'))?'selected':'' }} @endif>غیرفعال</option>
                                                </select>
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
                                                    document.getElementById("fullname-filter").value = "";
                                                    document.getElementById("email-filter").value = "";
                                                    document.getElementById("mobile-filter").value = "";
                                                    document.getElementById("nationalcode-filter").value = "";
                                                    $("#status-filter").val(null).trigger("change");
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
                                            <th><b class="IRANYekanRegular">نام</b></th>
                                            <th><b class="IRANYekanRegular">تصویر</b></th>
                                            <th><b class="IRANYekanRegular">آدرس ایمیل</b></th>
                                            <th><b class="IRANYekanRegular">موبایل</b></th>
                                            <th><b class="IRANYekanRegular">وضعیت</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($doctors as $index=>$doctor)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $doctor->fullname }}</strong></td>
                                            <td>    
                                               @if($doctor->image == null)
                                                <img src="{{ url('/') }}/panel/assets/images/profile.png" width="50" height="50" class="rounded-circle">
                                                @else
                                                <img src="{{  $doctor->get_image('thumbnail') }}" width="50" height="50" class="rounded-circle">
                                                @endif
                                            </td>
                                            <td><strong class="IRANYekanRegular">{{ $doctor->email }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $doctor->mobile }}</strong></td>              

                                            <td>    
                                                @if($doctor->status==App\Enums\Status::Active)
                                                <span class="badge badge-primary IR  p-1">فعال</span>
                                                @elseif($doctor->status==App\Enums\Status::Deactive)
                                                <span class="badge badge-danger IR  p-1">غیرفعال</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($doctor->trashed())

                                                    <a class="font18" href="#recycle{{ $doctor->id }}" data-toggle="modal" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                    <div class="modal fade" id="recycle{{ $doctor->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">بازیابی ادمین</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید {{ $doctor->fullname }} را بازیابی نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.admins.recycle', $doctor) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" title="بازیابی" class="btn btn-info px-8">بازیابی</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            
                                                @else

                                                    <a class="font18 m-1" href="{{ route('admin.doctors.info', $doctor) }}" title="اطلاعات پزشک">
                                                        <i class="fa fa-info text-success"></i>
                                                    </a>

                                                    <a class="font18 m-1" href="{{ route('admin.admins.medias.index', $doctor) }}" title="شبکه‌های اجتماعی">
                                                        <i class="fab fa-instagram text-danger"></i>
                                                    </a>
                                                
                                                    <a class="font18 m-1" href="{{ route('admin.admins.feilds.index', $doctor) }}" title="رشته های تحصیلی">
                                                        <i class="fas fa-user-graduate text-secondray"></i>
                                                    </a>

                                                    <a class="font18 m-1" href="{{ route('admin.admins.address.show', $doctor) }}" title="آدرس">
                                                        <i class="fas fa-map-marker-alt text-warning"></i>
                                                    </a>

                                                    <a class="font18 m-1" href="{{ route('admin.admins.edit', $doctor) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-success"></i>
                                                    </a>

                                  
                                                    <a href="#remove{{ $doctor->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                         
                                                @endif

                                                <!-- Remove Modal -->
                                                <div class="modal fade" id="remove{{ $doctor->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-xs">
                                                        <div class="modal-content">
                                                            <div class="modal-header py-3">
                                                                <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف ادمین</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید {{ $doctor->fullname }} را حذف نمایید؟</h5>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('admin.admins.destroy', $doctor) }}"  method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" title="حذف" class="btn btn-danger px-8">حذف</button>
                                                                </form>
                                                                <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                             
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $doctors->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
