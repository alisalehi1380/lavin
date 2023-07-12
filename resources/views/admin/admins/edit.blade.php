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
                            {{ Breadcrumbs::render('admins.edit',$admin) }}
                            </ol>
                        </div>
                        <h4 class="page-title">
                            <i class="fas fa-users page-icon"></i>
                            ویرایش ادمین
                        </h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body" style="padding:70px;">

                            <form method="POST" action="{{ route('admin.admins.update',$admin) }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right IRANYekanRegular">عکس پرسنلی:</label>
                                    <div class="fileupload btn btn-success waves-effect waves-light mb-3">
                                        <span><i class="mdi mdi-cloud-upload mr-1"></i>آپلود</span>
                                        <input type="file" class="upload" name="image" value="{{ old('image') }}">
                                        @if($admin->image == null)
                                        <img src="{{ url('/') }}/panel/assets/images/profile.png" width="40" height="40" class="rounded-circle">
                                        @else
                                        <img src="{{  $admin->get_image('thumbnail') }}" width="40" height="40" class="rounded-circle">
                                        @endif
                                    </div>
                                    <span class="form-text text-danger erroralarm"> {{ $errors->first('image') }} </span>
                                </div>

                                <div class="form-group row">
                                    <label for="fullname" class="col-md-4 col-form-label text-md-right IRANYekanRegular">نام و نام خانوادگی:</label>
                                    <div class="col-md-6">
                                        <input id="fullname" type="text" class="form-control  @error('fullname') is-invalid @enderror" name="fullname" value="{{  old('fullname') ?? $admin->fullname  }}"  autofocus placeholder="نام و نام خانوادگی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('name') }} </span>
                                    </div>
                                </div>
 
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-4 col-form-label text-md-right IRANYekanRegular">موبایل:  </label>
                                    <div class="col-md-6">
                                        <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror ltr" name="mobile"  value="{{ old('mobile') ?? $admin->mobile    }}" placeholder="موبایل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('mobile') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nationalcode" class="col-md-4 col-form-label text-md-right IRANYekanRegular">کدملی:  </label>
                                    <div class="col-md-6">
                                        <input id="nationalcode" type="text" class="form-control @error('nationalcode') is-invalid @enderror ltr" name="nationalcode"  value="{{ old('nationalcode') ?? $admin->nationalcode }}" placeholder="کدملی">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('nationalcode') }} </span>
                                    </div>
                                </div>
 
                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right IRANYekanRegular">آدرس ایمیل:</label>
                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror ltr"  name="email" value="{{ old('email') ?? $admin->email }}" autocomplete="email"  placeholder="آدرس ایمیل">
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('email') }} </span>
                                    </div>
                                </div>

                                 
                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right IRANYekanRegular">نقش‌ها:</label>
                                    <div class="col-md-6">
                                    <select name="roles[]" id="roles" class="select2 select2-multiple text-right IRANYekanRegular" multiple="multiple" multiple data-placeholder="انتخاب نقش‌ها...">
                                        @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array(trim($role->id),$admin->roles->pluck('id')->toArray())?'selected':'' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="form-text text-danger erroralarm"> {{ $errors->first('roles') }} </span>
                                    </div>
                                </div>
                              
                                <div class="form-group row">

                                    <div class="col-md-6 text-right">
                                        <label for="gender" class="col-md-4 col-form-label  IRANYekanRegular">جنسیت:</label>
                                        <select name="gender" id="gender" class="dropdown text-right IRANYekanRegular"  data-placeholder="انتخاب جنسیت...">
                                            <option value="{{ App\Enums\genderType::male }}" {{ App\Enums\genderType::male==$admin->gender?'selected':'' }}>مرد</option>
                                            <option value="{{ App\Enums\genderType::famale }}" {{ App\Enums\genderType::famale==$admin->gender?'selected':'' }}>زن</option>
                                            <option value="{{ App\Enums\genderType::other }}" {{ App\Enums\genderType::other==$admin->gender?'selected':'' }}>دوجنسه</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('gender') }} </span>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status" class="col-form-label  IRANYekanRegular">وضعیت:</label>
                                        <select name="status" id="statu" class="dropdown text-right IRANYekanRegular"  data-placeholder="انتخاب وضعیت...">
                                            <option value="{{ App\Enums\Status::Active }}" {{ App\Enums\Status::Active==$admin->status?'selected':'' }}>فعال</option>
                                            <option value="{{ App\Enums\Status::Deactive }}" {{ App\Enums\Status::Deactive==$admin->status?'selected':'' }}>غیرفعال</option>
                                        </select>
                                        <span class="form-text text-danger erroralarm"> {{ $errors->first('status') }} </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-9 text-center">
                                        <div id="cancel" class="cancel" onclick="cancel()">لغو</div>
                                        <div id="changepass" class="changepass" onclick="changepassword()">تغییر رمز عبور</div>
                                    </div>
                                </div>


                                    <div class="form-group row">
                                        <label for="password" id="label-password" class="col-md-4 col-form-label text-md-right IRANYekanRegular" style="display:none">رمز عبور:</label>
                                        <div class="col-md-6">
                                            <input id="password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password')  }}"  autocomplete="new-password" placeholder="رمز عبور" style="display:none">
                                            <span class="form-text text-danger erroralarm"> {{ $errors->first('password') }} </span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="confirm_password"  id="label-confirm_password" class="col-md-4 col-form-label text-md-right IRANYekanRegular" style="display:none">تکرار رمز عبور:</label>

                                        <div class="col-md-6">
                                            <input id="confirm_password" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="new-password" placeholder="تکرار رمز عبور" style="display:none">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-info">بروزرسانی</button>
                                        </div>
                                        <div class="col-md-4"></div>
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

