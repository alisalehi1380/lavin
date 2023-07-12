<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>بازیابی رمز عبور</title>
    </head>

    <body>

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4 text-left">
                                
                                <p class="text-muted mb-4 mt-3 IRANYekanRegular">
                                    .برای حساب کاربری شما درخواست بازیابی رمز عبور شده است. در صورتی که این درخواست توسط شما ارسال نشده است این ایمیل را نادیده بگیرید. در غیر این صورت جهت بازیابی رمز عبور خود بر روی لینک زیر کلیک نمایید
                                 </p>

                                 <a href="{{ env('HOME_URL') }}/admin/changePass/{{ $token}}">بازیابی  رمز عبور</a>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

    </body>
</html>