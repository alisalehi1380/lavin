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

                            @if (\Session::has('errors'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{!! \Session::get('errors') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <div class="card-body p-4">

                                <div class="text-center w-75 m-auto">

                                    <a href="index.html">
                                        <span><img src="{{ url('/') }}/panel/assets/images/logo-dark.png" alt="" height="22"></span>
                                    </a>

                                    <p class="text-muted mb-4 mt-3 IRANYekanRegular">آدرس ایمیل و رمز عبور خود را وارد نمایید.</p>


                                </div>

                                <form action="{{ route('website.login') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="emailaddress IRANYekanRegular">شماره موبایل:</label>
                                        <input class="form-control IRANYekanRegular text-right" type="text" id="mobile" name="mobile"  placeholder="شماره موبایل...">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password IRANYekanRegular">رمز عبور:</label>
                                        <input class="form-control IRANYekanRegular text-right" type="password"  name="password" id="password" placeholder="رمز عبور ..." required="">
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input IRANYekanRegular" id="remember" name="remember" checked>
                                            <label class="custom-control-label IRANYekanRegular" for="remember">مرا به خاطر بسپار</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block IRANYekanRegular" type="submit">ورود </button>
                                    </div>

                                </form>






                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="{{ route('admin.forgotPass') }}" class="text-muted ml-1">رمز عبور را فراموش کردید؟</a></p>
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
        @include('sweet::alert')
    </body>
</html>
