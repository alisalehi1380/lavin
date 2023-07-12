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
                                {{ Breadcrumbs::render('users') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                             <i class="fas fa-users page-icon"></i>
                               کاربران عادی
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
                                     @if(Auth::guard('admin')->user()->can('users.create')) 
                                    <div class="btn-group">
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-plus plusiconfont"></i>
                                            <b class="IRANYekanRegular">افزودن کاربر جدید</b>
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
                                                <label for="name" class="control-label IRANYekanRegular">نام و نام خانوادگی</label>
                                                <input type="text"  class="form-control input" id="name-filter" name="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ request('name') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="mobile-filter" class="control-label IRANYekanRegular">موبایل</label>
                                                <input type="text"  class="form-control input" id="mobile-filter" name="mobile" placeholder="موبایل را وارد کنید" value="{{ request('mobile') }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="email-filter" class="control-label IRANYekanRegular">آدرس ایمیل</label>
                                                <input type="text"  class="form-control input" id="email-filter" name="email" placeholder="آدرس ایمیل را وارد کنید...." value="{{ request('email') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="gender" class="control-label IRANYekanRegular">جنسیت</label>
                                                 <select name="gender[]" id="gender-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... جنسیت‌های مورد نظر را انتخاب نمایید">
                                                    <option value="{{ App\Enums\genderType::male }}" @if(request('gender')!=null) {{ in_array(App\Enums\genderType::male,request('gender'))?'selected':'' }} @endif>مرد</option>
                                                    <option value="{{ App\Enums\genderType::famale }}" @if(request('famale')!=null) {{ in_array(App\Enums\genderType::famale,request('gender'))?'selected':'' }} @endif>زن</option>
                                                    <option value="{{ App\Enums\genderType::other }}" @if(request('gender')!=null) {{ in_array(App\Enums\genderType::other,request('gender'))?'selected':'' }} @endif>غیره...</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="name" class="control-label IRANYekanRegular">سطوح</label>
                                                 <select name="levels[]" id="levels-filter" class="form-control select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="... سطوح مورد نظر را انتخاب نمایید">
                                                    @foreach($levels as $level)
                                                    <option value="{{ $level->id }}" @if(request('levels')!=null) {{ in_array($levels->id,request('levels'))?'selected':'' }} @endif>{{ $level->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="code-filter" class="control-label IRANYekanRegular">کد کاربر</label>
                                                <input type="text"  class="form-control input" id="code-filter" name="code" placeholder="کد کاربر را وارد کنید" value="{{ request('code') }}">
                                            </div>
                                       </div>

                                       <div class="row">
                                            <div class="form-group justify-content-center col-6">
                                                <label for="introduced-filter" class="control-label IRANYekanRegular">کد معرف</label>
                                                <input type="text"  class="form-control input" id="introduced-filter" name="introduced" placeholder="کد معرف را وارد کنید" value="{{ request('introduced') }}">
                                            </div>

                                            <div class="form-group justify-content-center col-6">
                                                <label for="nationcode-filter" class="control-label IRANYekanRegular">کد ملی</label>
                                                <input type="text"  class="form-control input" id="nationcode-filter" name="nationcode" placeholder="کد ملی را وارد کنید" value="{{ request('nationcode') }}">
                                            </div>
                                       </div>

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
                                                    document.getElementById("mobile-filter").value = "";
                                                    document.getElementById("email-filter").value = "";
                                                    document.getElementById("code-filter").value = "";
                                                    document.getElementById("introduced-filter").value = "";
                                                    document.getElementById("nationcode-filter").value = "";
                                                    $("#gender-filter").val(null).trigger("change");
                                                    $("#levels-filter").val(null).trigger("change");

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
                                            <th><b class="IRANYekanRegular">نام خانوادگی</b></th>
                                            <th><b class="IRANYekanRegular">شماره ملی</b></th>
                                            <th><b class="IRANYekanRegular">شماره تماس</b></th>
                                            <th><b class="IRANYekanRegular">جنسیت</b></th>
                                            <th><b class="IRANYekanRegular">سطح</b></th>
                                            <th><b class="IRANYekanRegular">امتیاز</b></th>
                                            <th><b class="IRANYekanRegular">اقدامات</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $index=>$user)
                                        <tr>
                                            <td><strong class="IRANYekanRegular">{{ ++$index }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $user->firstname }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $user->lastname }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $user->nationcode }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $user->mobile }}</strong></td>
                                            <td>
                                                @switch($user->gender)
                                                    @case(App\Enums\genderType::male)
                                                    <span class="badge badge-primary IR p-1">مرد</span>
                                                    @break
                                                    @case(App\Enums\genderType::famale)
                                                    <span class="badge badge-success IR p-1">زن</span>
                                                    @break
                                                    @case(App\Enums\genderType::other)
                                                    <span class="badge badge-danger IR p-1">دوجنسه</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td><strong class="IRANYekanRegular">{{ $user->level->title }}</strong></td>
                                            <td><strong class="IRANYekanRegular">{{ $user->point }}</strong></td>
                                            <td>
                                                @if($user->trashed())
                                                    @if(Auth::guard('admin')->user()->can('users.destroy'))
                                                    <a class="font18" href="#recycle{{ $user->id }}" data-toggle="modal" title="بازیابی">
                                                        <i class="fa fa-recycle text-danger"></i>
                                                    </a>

                                                    <!-- Recycle Modal -->
                                                    <div class="modal fade" id="recycle{{ $user->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">بازیابی ادمین</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواید این کاربر را بازیابی کنید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.users.recycle', $user) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit" title="بازیابی" class="btn btn-info px-8">بازیابی</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @else

                                                    <a href="#info{{ $user->id }}" data-toggle="modal" class="font18 m-1" title="نمایش جزئیات">
                                                        <i class="fa fa-info text-warning"></i>
                                                    </a>

                                                    <!-- Info Modal -->
                                                    <div class="modal fade" id="info{{ $user->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">جزئیات کاربر</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <P class="IR">نام: {{ $user->firstname  }}</p>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <P class="IR"> نام خانوادگی: {{ $user->lastname  }}</p>
                                                                        </div>

                                                                    </div>


                                                                    <div class="row">
                                                                         <div class="col-6">
                                                                            <P class="IR"> موبایل: {{ $user->mobile }}</p>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <P class="IR"> ایمیل: {{ $user->info->email ?? '' }}</p>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <P class="IR"> کد کاربر: {{ $user->code }}</p>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <P class="IR"> کد معرف: {{ $user->introduced }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                         <div class="col-6">
                                                                            <P class="IR"> سطح کاربر: {{ $user->level->title }}</p>
                                                                        </div>

                                                                        <div class="col-6">
                                                                            <P class="IR"> امتیاز: {{ $user->point }}</p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            @switch($user->gender)
                                                                                @case(App\Enums\genderType::male)
                                                                                جنسیت: <span class="badge badge-primary IR p-1">مرد</span>
                                                                                @break
                                                                                @case(App\Enums\genderType::famale)
                                                                                جنسیت: <span class="badge badge-success IR p-1">زن</span>
                                                                                @break
                                                                                @case(App\Enums\genderType::other)
                                                                                جنسیت: <span class="badge badge-danger IR p-1">دوجنسه</span>
                                                                                @break
                                                                            @endswitch
                                                                        </div>
                                                                    </div>

                                                                 </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" title="انصراف" data-dismiss="modal">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @if(Auth::guard('admin')->user()->can('users.edit'))
                                                    <a class="font18 m-1" href="{{ route('admin.users.edit', $user) }}" title="ویرایش">
                                                        <i class="fa fa-edit text-success"></i>
                                                    </a>
                                                    @endif

                                                    @if(Auth::guard('admin')->user()->can('users.destroy'))
                                                    <a href="#remove{{ $user->id }}" data-toggle="modal" class="font18 m-1" title="حذف">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>

                                                     <!-- Remove Modal -->
                                                    <div class="modal fade" id="remove{{ $user->id }}" tabindex="-1" aria-labelledby="reviewLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-xs">
                                                            <div class="modal-content">
                                                                <div class="modal-header py-3">
                                                                    <h5 class="modal-title IRANYekanRegular" id="newReviewLabel">حذف ادمین</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5 class="IRANYekanRegular">آیا مطمئن هستید که میخواهید {{ $user->name }} را حذف نمایید؟</h5>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('admin.users.destroy', $user) }}"  method="POST" class="d-inline">
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
                                {{ $users->render() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
