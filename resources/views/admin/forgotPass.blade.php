<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>پنل مدیریت</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{ url('/') }}/panel/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/panel/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/panel/assets/css/app-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/panel/assets/css/share.css" rel="stylesheet" type="text/css" />

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>

    <body>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="index.html">
                                    <span><img src="{{ url('/') }}/panel/assets/images/logo-dark.png" alt="لاوین"></span>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">لطفا آدرس ایمیل خود را جهت ارسال فرم بازیابی رمز عبور وارد نمایید.</p>
                                </div>

                                <form action="{{ route('admin.recoveyPass') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="IRANYekanRegular">آدرس ایمیل:</label>
                                        <input class="form-control IRANYekanRegular text-right" type="email" id="email" name="email"  placeholder="آدرس ایمیل...">
                                    </div>

          
                                    <div class="form-group mb-0 text-center mt-3">
                                        <button class="btn btn-primary btn-block IRANYekanRegular" type="submit">دریافت فرم بازیابی رمز عبور</button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="{{ route('admin.login') }}" class="text-muted ml-1">بازگشت به صفحه ورود</a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <footer class="footer footer-alt">
           طراحی و توسعه توسط <a href="http://tkp.ir" class="text-muted" target="_blanck">تک پرداز</a> 
        </footer>

        <!-- Vendor js -->
        <script src="{{ url('/') }}/admin/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="{{ url('/') }}/admin/assets/js/app.min.js"></script>
        @include('sweetalert::alert')
    </body>
</html>