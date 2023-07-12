@extends('layouts.master')

@section('content')
    <div class="position-relative pb-5">
        @include('layouts.header',['title'=>'نمونه کارهای کلینیک لاوین','background'=>'/images/front/service-bg.jpg'])
        <div class="px-lg-5 text-center w-100 position-absolute" style="bottom: 0">
{{--            <h1 class="h3 dima text-pink">درباره‌ی کلینیک لاوین</h1>--}}
            <div class="text-gray pt-3">به مدیریت دکتر علی اکبر جعفری</div>

            <div class="row mx-0 justify-content-center  mt-2 mb-3">
                <a class="badge bg-light rounded-circle d-flex mr-1" style="width: 30px; height: 30px;" href="#">
                    <i class="fab fa-facebook-f m-auto"></i>
                </a>
                <a class="badge bg-light rounded-circle d-flex mr-1" style="width: 30px; height: 30px;" href="#">
                    <i class="fab fa-twitter m-auto"></i>
                </a>
                <a class="badge bg-light rounded-circle d-flex mr-1" style="width: 30px; height: 30px;" href="#">
                    <i class="fab fa-linkedin m-auto"></i>
                </a>
                <a class="badge bg-light rounded-circle d-flex mr-1" style="width: 30px; height: 30px;" href="#">
                    <i class="fab fa-google-plus m-auto"></i>
                </a>
            </div>

        </div>

    </div>
    <section class="w-100 banner">

        <div class="container py-5">
            <div class="rgba-black rounded-xl text-white p-2 p-xl-5">
                درمانگاه شبانه روزی لاوین دارای مجوز رسمی از وزارت بهداشت، درمان و آموزش پزشکی با مدیریت آقای دکتر علی جعفری می باشد که در جهت ارائه خدمات مطلوب، موثر و ماندگار  فعالیت می کند.

                هدف این مجموعه ارائه بهترین خدمات با استفاده از جدیدترین و پیشرفته ترین دستگاهها در محیطی مدرن و آرامش بخش مطابق با استانداردهای FDA و وزارت بهداشت، درمان و آموزش پزشکی جمهوری اسلامی ایران می باشد.

                این کلینیک با بهره گیری از همکاران متخصص و مجرب در زمینه های جراحی پلاستیک، پوست، مو، زیبایی و لیزر و تغذیه و رژیم درمانی و دندانپزشکی و متخصص زنان،جراح عمومی و پزشک عمومی خدمات خود را ارائه می دهد.

                کلینیک لاوین با کادری مجرب، محیط مناسب و امکانات و تجهیزات به روز دنیا تمامی خدمات حوزه پوست، مو، لیزر ، زیبایی، تناسب اندام، دندانپزشکی، زنان و زایمان و درمان های عمومی را به مراجعه کنندگان محترم ارائه می نماید. همچنین این کلینیک با داشتن پرسنل خوش برخورد و کادر درمانی بسیار مجرب، تجربه دلنشینی را با بهره گیری از تجهیزات به روز دنیا زیبایی ماندگاری را برای شما زیر نظر متخصصان مجرب به ارمغان می آورد.

            </div>
        </div>

    </section>
    <section class="col-12 pb-5">
        <h2 class="h5 dima text-pink text-center py-5">معرفی بخش های لاوین</h2>
        <div class="col-12 justify-content-center row mx-0">
            <div class="col-md-6 text-center text-white col-xl-3 mb-3 mb-md-0">

                <div class="bg-light-grey text-dark rounded-xl py-3">
                    <b class="py-3 font-weight-bold text-black">بخش‌های عمومی</b>
                    <div class="pt-1">درمانگاه</div>
                    <div class="pt-1">دندانپزشکی</div>
                </div>

            </div>
            <div class="col-md-6 text-center text-white col-xl-3 mb-3 mb-md-0">
                <div class="bg-light-grey text-dark rounded-xl py-3">
                    <b class="py-3 font-weight-bold text-black">بخش‌های تخصصی</b>
                    <div class="pt-1">کلیه خدمات زیبایی</div>
                    <div class="pt-1">لیزر</div>
                    <div class="pt-1">کاشت مو</div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-light py-5">
        <div class="container">
            <div class="col-12 row mx-0">
                <div class="col-md-3">
                    <img src="/images/front/dr-jafari.png" alt="">
                </div>
                <div class="col-md-9">
                    <div class="w-100">
                        <i class="fa fa-quote-right text-pink h3"></i>
                    </div>
                    <div>
                        <h4>مدیریت درمانگاه لاوین</h4>
                        دکتر علی اکبر جعفری پزشک و مدیر درمانگاه شبانه روزی لاوین رشت ، دانش آموخته کورس پزشکی از دانشگاه گیلان ، دارای مدرک بین المللی نخ لیفت از نماینده خاورمیانه دانشگاه امریکن یونیورسیتی و دارای مدرک بین المللی لیزر پزشکی از نماینده آسیا و اقیانوسیه شرکت کوترا آمریکا هستند.
                        دکتر علی اکبر جعفری به عنوان برترین پزشک استان گیلان در حوزه مشتری مداری طبق نظر سنجی موسسه راستین ایرانیان انتخاب شده اند.

                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@push('css')
    <style>

        .border-accent{
            border-color:#2ed3ae !important;
        }
        .banner{
            background-image: url('/images/front/paziresh.jpg');
            background-size: cover;
            background-position: center;
        }
        .rgba-black{
            background-color: rgba(0, 0, 0, 0.62);
        }

    </style>
@endpush
