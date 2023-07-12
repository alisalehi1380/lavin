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
                                {{ Breadcrumbs::render('admin-create') }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-users page-icon"></i>
                            افزودن ادمین جدید
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" style="padding:70px;">

                            <form method="POST" action="{{ route('admin.admins.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right IRANYekanRegular">عکس پرسنلی:</label>
                                    <div class="fileupload btn btn-success waves-effect waves-light mb-3">
                                        <span><i class="mdi mdi-cloud-upload mr-1"></i>آپلود</span>
                                        <input type="file" class="upload" name="image" value="{{ old('image') }}">
                                    </div>
                                    <span class="form-text text-danger erroralarm"> {{ $errors->first('image') }} </span>
                                </div>

                                <div class="form-group row">
                                    <label for="fullname" class="col-md-4 col-form-label text-md-right IRANYekanRegular">نام و نام خانوادگی:</label>
                                    <div class="col-md-6">
                                        <input id="fullname" type="text" class="form-control  @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}"  autofocus placeholder="نام و نام خانوادگی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('fullname') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nationalcode" class="col-md-4 col-form-label text-md-right IRANYekanRegular">کدملی:</label>
                                    <div class="col-md-6">
                                        <input id="nationalcode" type="text" class="form-control  @error('nationalcode') is-invalid @enderror" name="nationalcode" value="{{ old('nationalcode') }}"  autofocus placeholder="کدملی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('nationalcode') }} </span>
                                    </div>
                                </div>
 
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-4 col-form-label text-md-right IRANYekanRegular">موبایل:  </label>

                                    <div class="col-md-6">
                                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror ltr" name="mobile"  value="{{ old('mobile') }}" placeholder="موبایل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                                    </div>
                                </div>
 
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right IRANYekanRegular">آدرس ایمیل:</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror ltr"  name="email" value="{{ old('email') }}" autocomplete="email"  placeholder="آدرس ایمیل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('email') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right IRANYekanRegular">رمز عبور:</label>
                                    <div class="col-md-6">
                                        <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror ltr" name="password" value="{{ old('password') }}"  autocomplete="new-password" placeholder="رمز عبور">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('password') }} </span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="confirm_password" class="col-md-4 col-form-label text-md-right IRANYekanRegular">تکرار رمز عبور:</label>

                                    <div class="col-md-6">
                                        <input id="confirm_password" type="password" class="form-control ltr" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="new-password" placeholder="تکرار رمز عبور">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right IRANYekanRegular">نقش‌ها:</label>
                                    <div class="col-md-6">
                                    <select name="roles[]" id="roles" class="select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب نقش‌ها...">
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                       @endforeach
                                    </select>
                                    <span class="form-text text-danger erroralarm"> {{ $errors->first('roles') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-6 text-right">
                                        <label for="gender" class="col-md-4 col-form-label  IRANYekanRegular">جنسیت:</label>
                                        <select name="gender" id="gender" class="dropdown text-right IRANYekanRegular"  data-placeholder="انتخاب جنسیت...">
                                            <option value="{{ App\Enums\genderType::male }}">مرد</option>
                                            <option value="{{ App\Enums\genderType::famale }}">زن</option>
                                            <option value="{{ App\Enums\genderType::other }}">غیره...</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('gender') }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status" class="col-form-label  IRANYekanRegular">وضعیت:</label>
                                        <select name="status" id="statu" class="dropdown text-right IRANYekanRegular"  data-placeholder="انتخاب وضعیت...">
                                            <option value="{{ App\Enums\Status::Active }}">فعال</option>
                                            <option value="{{ App\Enums\Status::Deactive }}">غیرفعال</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-5 text-right">
                                        <button type="submit" class="btn btn-primary">ثبت</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>
 
@endsection

 