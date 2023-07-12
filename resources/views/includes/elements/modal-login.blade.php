<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded">

            <div class="tab-content px-lg-4 pt-2" id="myTabContent">
                <a href="#" data-dismiss="modal" class="position-relative" style="z-index: 1">
                    <i class="fa fa-times px-4"></i>
                </a>
                <div class="tab-pane fade show active" id="login-tab" role="tabpanel" >
                    <form id="login-form">
                        <div class="col-md-8">
                            <div class="text-accent dima heading-3 pb-3" style="width: 140px;border-bottom: 3px solid #dbdbdb">
                                <span >ورود</span>
                            </div>

                            <div class="form-control w-100 mt-4">
                                <label for="l-mobile" class="w-100 small text-black mb-0">موبایل</label>
                                <input type="text" id="l-mobile" name="mobile" class="w-100 text-left px-2">
                            </div>

                            <div class="form-control w-100 mt-1">
                                <label for="l-pass" class="w-100 small text-black mb-0">رمز عبور</label>
                                <input type="password" id="l-pass" name="password" class="w-100 form-control text-left px-2">
                            </div>
                            <div><a href="#" class="small d-inline">رمزعبور را فراموش کردم</a></div>

                            <div class="mt-4 mb-3">
                                <input onclick="sender('login')" value="ورود به کلینیک" class="btn btn-sm small rounded-0 pointer btn-outline-dark">
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12 justify-content-center pt-4 pb-3 nav nav-tabs">
                        <span onclick="$(this).removeClass('active')" data-target="#register-tab" data-toggle="tab" class="text-primary pointer small">هنوز ثبت نام نکردم</span>
                    </div>
                </div>

                <div class="tab-pane fade" id="register-tab" role="tabpanel">

                    <form id="register-form">
                        <div class="col-md-8">
                            <div class="text-accent dima heading-3 pb-3" style="width: 140px;border-bottom: 3px solid #dbdbdb">
                                <span >ثبت نام</span>
                            </div>

                            <div class="form-control w-100 mt-4">
                                <label for="l-firstname" class="w-100 small text-black mb-0">نام</label>
                                <input type="text" id="l-firstname" required name="firstname" class="w-100 px-2" >
                            </div>

                            <div class="form-control w-100 mt-2">
                                <label for="l-lastname" class="w-100 small text-black mb-0">نام خانوادگی</label>
                                <input type="text" id="l-lastname" required name="lastname" class="w-100 px-2" >
                            </div>

                            
                            <div class="form-control w-100 mt-2">
                                <label for="l-nationcode" class="w-100 small text-black mb-0">کد ملی</label>
                                <input type="text" id="l-nationcode" required name="nationcode" class="w-100 text-left px-2" >
                            </div>
                            
                            <div class="form-control w-100 mt-2">
                                <label for="l-mobile" class="w-100 small text-black mb-0">موبایل</label>
                                <input type="text" id="l-mobile" required name="mobile" class="w-100 text-left px-2" >
                            </div>

                            <div class="form-control w-100 mt-2">
                                <label for="l-introduced" class="w-100 small text-black mb-0">کد معرف (اختیاری)</label>
                                <input type="text" id="l-introduced" name="introduced" class="w-100 text-left px-2" >
                            </div>

                            <div class="form-control w-100 mt-2">
                                <label for="l-pass" class="w-100 small text-black mb-0">رمز عبور</label>
                                <input type="password" id="l-pass" required class="w-100 text-left px-2" name="password" >
                            </div>
                            <div class="form-control w-100 mt-2">
                                <label for="l-pass" class="w-100 small text-black mb-0">تکرار رمز عبور</label>
                                <input type="password" id="l-pass" required class="w-100 text-left px-2" name="password_confirmation">
                            </div>

                            <div class="form-control w-100 mt-2">
                                <label class="m-1 p-1">
                                <input type="radio" name="gender" value="1" checked> مرد
                                </label>
                                <label class="m-1 p-1">
                                <input type="radio" name="gender" value="2"> زن
                                </label>
                                <label class="m-1 p-1">
                                <input type="radio" name="gender" value="3"> غیره
                                </label>
                            </div>

                            <div class="mt-4 mb-3">
                                <input onclick="sender('register')" value="ثبت نام" class="btn btn-sm small rounded-0 pointer btn-outline-dark">
                            </div>
                        </div>
                    </form>

                    <div class="col-md-12 justify-content-center pt-4 pb-3 nav nav-tabs">
                        <span onclick="$(this).removeClass('active')" data-target="#login-tab" data-toggle="tab" class="text-primary small pointer">قبلا ثبت نام کردم</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('js')
    <script>

        function sender(type){

            // data definition
            let form = $(`#${ type }-form`).serialize();
            const register_endpoint = "{{ route('website.register') }}";
            const login_endpoint = "{{ route('website.login') }}";
            // axios for login and register
            axios.post(type === "login" ? login_endpoint : register_endpoint ,form).then(res => {
                if(res.status == 200){
                    window.location.reload();
                }
            }).catch(err => {
                let errors = ``;

                if(err.response.status == 401){
                    errors += `<li class="border border-top-0 border-right-0 border-left-0">
                       <i class="fa fa-times-circle px-2 text-danger"></i>${ err.response.data.message }
                    </li>`
                }else{
                    $.map(err.response.data.errors,item =>{
                        errors += `<li class="border border-top-0 border-right-0 border-left-0">
                       <i class="fa fa-times-circle px-2 text-danger"></i>${ item[0] }
                    </li>`
                    });
                }

                Swal.fire({
                    title: 'لطفا موارد زیر را در فرم بررسی کنید:',
                    html: `<ul class="text-right mx-md-5">${errors}</ul>`,
                    confirmButtonColor: 'red',
                    confirmButtonText: "باشه"
                });
            })
        }

    </script>
@endpush
