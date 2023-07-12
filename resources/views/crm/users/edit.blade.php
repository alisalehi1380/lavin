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
                            <i class="fa fa-user page-icon"></i>
                             ویرایش کاربر
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.users.update',$user) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')

                                <div class="form-group row mt-3">
                                    <div class="col-12 col-md-6">
                                        <label for="firstname" class="IRANYekanRegular">نام:</label>
                                        <input id="firstname" type="text" class="form-control  @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') ?? $user->firstname }}"  autofocus placeholder="نام">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('firstname') }} </span>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="lastname" class="IRANYekanRegular">نام خانوادگی:</label>
                                        <input id="lastname" type="text" class="form-control  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') ?? $user->lastname }}"  autofocus placeholder="نام خانوادگی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('firstname') }} </span>
                                    </div>
                                </div>

 
                                <div class="form-group row">
                                    <div class="col-12 col-md-6">
                                        <label for="mobile" class="IRANYekanRegular">موبایل:</label>
                                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror ltr" name="mobile"  value="{{ old('mobile') ??  $user->mobile }}" placeholder="موبایل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="introduced" class="IRANYekanRegular">کد معرف:</label>
                                        <input id="introduced" type="text" class="form-control @error('introduced') is-invalid @enderror ltr" name="introduced"  value="{{ old('introduced') ??  $user->introduced }}" placeholder="کد معرف">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('introduced') }} </span>
                                    </div>
                                </div>
 
                                 
                                <div class="form-group row mt-2">
                                    <div class="col-12 col-md-6">
                                        <label for="gender" class="IRANYekanRegular">جنسیت:</label>
                                        <select name="gender" id="gender" class="dropdown text-center IRANYekanRegular"  data-placeholder="انتخاب جنسیت...">
                                            <option value="{{ App\Enums\genderType::male }}" {{ App\Enums\genderType::male==$user->gender?'selected':'' }}>مرد</option>
                                            <option value="{{ App\Enums\genderType::famale }}" {{ App\Enums\genderType::famale==$user->gender?'selected':'' }}>زن</option>
                                            <option value="{{ App\Enums\genderType::other }}" {{ App\Enums\genderType::other==$user->gender?'selected':'' }}>غیره...</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('gender') }} </span>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="level" class="IRANYekanRegular">سطح:</label>
                                        <select name="level" id="level" class="dropdown text-center IRANYekanRegular">
                                            @foreach($levels as $level)
                                            <option value="{{ $level->id }}" {{ $level->id==$user->level_id?'selected':'' }}>{{ $level->title }}</option>
                                            @endforeach
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('level') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row mt-2">
                                    <div class="col-12 text-center">
                                        <div id="cancel" class="cancel" onclick="cancel()">لغو</div>
                                        <div id="changepass" class="changepass" onclick="changepassword()">تغییر رمز عبور</div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="password" id="label-password" class="col-md-4 col-form-label text-md-right IRANYekanRegular" style="display:none">رمز عبور:</label>
                                    <div class="col-md-6">
                                        <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror text-right" name="password" value="{{ old('password')  }}"  autocomplete="new-password" placeholder="رمز عبور" style="display:none">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('password') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password"  id="label-confirm_password" class="col-md-4 col-form-label text-md-right IRANYekanRegular" style="display:none">تکرار رمز عبور:</label>

                                    <div class="col-md-6">
                                        <input id="confirm_password" type="password" class="form-control text-right" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="new-password" placeholder="تکرار رمز عبور" style="display:none">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">بروزرسانی</button>
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
 
<script>
        //تطبیق رمز عبور
        var password = document.getElementById("password");
        var confirm_password = document.getElementById("confirm_password");

        function validatePassword()
        {
            if(password.value != confirm_password.value)
            {
                confirm_password.setCustomValidity("رمز عبور مطابقت ندارد");
                confirm_password.style.border="2px solid #f24040";
            }
            else
            {
                confirm_password.setCustomValidity('');
                confirm_password.style.border="0px";
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        function changepassword()
        {
            document.getElementById('password').setAttribute('required', '');
            document.getElementById('confirm_password').setAttribute('required', '');
            document.getElementById("changepass").style.display="none";
            document.getElementById("password").style.display="block";
            document.getElementById("label-password").style.display="block";
            document.getElementById("confirm_password").style.display="block";
            document.getElementById("label-confirm_password").style.display="block";
            document.getElementById("cancel").style.display="block";
        }

        function cancel()
        {
            document.getElementById("password").value="";
            document.getElementById('password').removeAttribute('required');
            document.getElementById("password").style.display="none";
            document.getElementById("label-password").style.display="none";
            document.getElementById("confirm_password").value="";
            document.getElementById('confirm_password').removeAttribute('required');
            document.getElementById("confirm_password").style.display="none";
            document.getElementById("label-confirm_password").style.display="none";
            document.getElementById("cancel").style.display="none";
            document.getElementById("changepass").style.display="block";
            confirm_password.setCustomValidity('');
        }
 </script>
 
@endsection

 