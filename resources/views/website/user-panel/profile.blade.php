@extends('layouts.master')

@section('content')
    <div id="profile">
        @include('layouts.header', ['title' => 'پروفایل کاربر'])
        <div class="text-center">
            <img src="/images/front/user.jpg" class="rounded-circle" width="100" height="100"
                 style="margin-bottom: -40px">
        </div>
    </div>
    <div class="col-12 row mx-0 justify-content-center mb-5 mt-3">

        <div class="mt-5 bg-white border col-md-8 pb-3">
            <div class="font-weight-bold p-2 text-black">احراز هویت</div>
            <div class="col-12 row mx-0 mt-2 py-2 bg-light" style="font-size: 14px">
                <div class="col-md-3 px-0 text-black">ایمیل</div>
                <div class="col-md-4 px-0" style="max-height: 28px;">
                    lavin@gmail.com <i onclick="updateInput('email-editor')" class="fa fa-pen-square pointer text-warning pr-2" style="font-size: 21px"></i>

                    <form action="" id="email-editor" class="input-group mb-3 w-100 position-relative" style="margin-top: -29px">
                        <input type="email" name="email" value="lavin@gmail.com" class="border border-secondary text-left border-left-0 py-0 pl-2" placeholder="ایمیل جدید">
                        <div class="input-group-append">
                            <button type="submit" class="btn py-1 px-2 btn-dark border-0 pointer" style="font-weight: 100">ثبت</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-4 px-0 font-weight-bold text-black"><span class="btn btn-sm py-0 btn-secondary pointer"> ارسال کد اعتبارسنجی</span></div>
                <div class="col-md-1 px-0 font-weight-bold text-black">
                    <span class="badge bg-pink text-white font-weight-light"><i class="fa fa-times-circle"></i> تایید نشده</span>
                    {{-- Don't delete , use it: <span class="badge bg-warning text-white font-weight-light"><i class="fa fa-clock"></i> درحال بررسی</span> --}}
                </div>
            </div>
            <div class="col-12 row mx-0 mt-2 py-2 bg-light" style="font-size: 14px">
                <div class="col-md-3 px-0 text-black">شماره تلفن</div>
                <div class="col-md-4 px-0" style="max-height: 28px;">
                    0910203040 <i onclick="updateInput('phone-editor')" class="fa fa-pen-square pointer text-warning pr-2" style="font-size: 21px"></i>

                    <form action="" id="phone-editor" class="input-group mb-3 w-100 position-relative" style="margin-top: -29px">
                        <input type="text" name="email" value="0910203040" class="border border-secondary text-left border-left-0 py-0 pl-2" placeholder="ایمیل جدید">
                        <div class="input-group-append">
                            <button type="submit" class="btn py-1 px-2 btn-dark border-0 pointer" style="font-weight: 100">ثبت</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-4 px-0 font-weight-bold text-black"><span class="btn btn-sm py-0 btn-secondary">ارسال کد اعتبارسنجی</span></div>
                <div class="col-md-1 px-0 font-weight-bold text-black">
                    <span class="badge bg-accent text-white font-weight-light"><i class="fa fa-check-circle"></i> تایید شده</span>
                </div>
            </div>
        </div>

        <div class="mt-5 bg-white border col-md-8 pb-3">
            <div class="font-weight-bold p-2 text-black">موقعیت مکانی</div>
            <form action="" class="py-2 px-md-5">
                <div class="col-md-10 px-0 row mx-auto">
                    <div class="form-control col-md-6 mt-2 mx-auto">
                        <label class="w-100 small text-black mb-0">استان</label>
                        <select name="" class="w-100 px-3 rounded-0 border border-secondary bg-white py-1">
                            <option ></option>
                            <option value="0">تهران</option>
                            <option value="1">گیلان</option>
                        </select>
                    </div>
                    <div class="form-control col-md-6 mt-2 mx-auto">
                        <label class="w-100 small text-black mb-0">شهر</label>
                        <select name="" class="w-100 px-3 rounded-0 border border-secondary bg-white py-1">
                            <option ></option>
                            <option value="0">رشت</option>
                            <option value="1">فومن</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-10 form-control mt-2 mx-auto">
                    <label class="w-100 small text-black mb-0">آدرس</label>
                    <textarea name="" class="w-100 px-3" rows="3"></textarea>
                </div>
                <div class="col-12 mt-3 text-center">
                    <input type="submit" class="button button-black" value="ارسال فرم">
                </div>
            </form>
        </div>

        <div class="mt-5 bg-white border col-md-8">
            <div class="font-weight-bold p-2 text-black">تغییر پسورد</div>
            <form action="" class="py-2 px-md-5">
                <div class="form-control col-md-7 mt-2 mx-auto">
                    <label class="w-100 small text-black mb-0">پسورد فعلی</label>
                    <input type="password" class="w-100 px-3 text-left" dir="ltr" placeholder="***">
                </div>
                <div class="form-control col-md-7 mt-2 mx-auto">
                    <label class="w-100 small text-black mb-0">پسورد جدید</label>
                    <input type="password" class="w-100 px-3 text-left" dir="ltr" placeholder="***">
                </div>
                <div class="form-control col-md-7 mt-2 mx-auto">
                    <label class="w-100 small text-black mb-0">تکرار پسورد جدید</label>
                    <input type="password" class="w-100 px-3 text-left" dir="ltr" placeholder="***">
                </div>
                <div class="col-12 mt-3 text-center">
                    <input type="submit" class="button button-black" value="ارسال فرم">
                </div>
            </form>
        </div>

    </div>

@stop

@push('js')
    <script>
        function updateInput(id){
            showInput(id);
        }

        function showInput(id){
            $('#'+id).css('visibility','visible').css('transform','scale(1)');
            setTimeout(()=>{
                $('#'+id).find('input').select();
            } , 100);
        }
    </script>
@endpush

@push('css')
    <style>
        #profile{
            background-image: url("/images/front/background-1.jpg");
            background-position: bottom;
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.15);
            background-blend-mode: color;
        }
        #email-editor ,#phone-editor{
            visibility: hidden;
            transition: all .2s;
            transform-origin: right;
            transform: scale(0);
        }
    </style>
@endpush
