@extends('layouts.master')

@section('content')
    <div class="col-12 text-center text-white bg-black small mt-5 mt-sm-0" style="z-index: 3;">
        <div><svg style="padding-top: 8px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="none" stroke="#ccad33" stroke-width="3"><circle cx="10" cy="10" r="10" stroke="none"/><circle cx="10" cy="10" r="8.5" fill="none"/></g><path d="M1306.01,13.366l4.637,3,4.637-5.183" transform="translate(-1300.647 -5.775)" fill="none" stroke="#ccad33" stroke-width="1"/></svg>
            درمانگاه به صورت شبانه روزی فعالیت می‌کند. جهت رزرو با شماره <a href="tel:0133636">0133636</a> تماس بگیرید</div>
    </div>
    <div class="text-center page">

        @include('includes.elements.menu')

        <section class="section swiper-container swiper-slider swiper-container-horizontal" id="home" data-loop="false" data-simulate-touch="false" data-autoplay="false">
        <div class="swiper-wrapper">
            <div class="swiper-slide-video swiper-slide swiper-slide-active" data-slide-bg="/images/front/banner.jpg" style="background-image: url('/images/front/banner.jpg'); background-size: cover;">
                <div class="swiper-slide-caption text-lg-right">
                    <div class="container container-wide">
                        <div class="row justify-content-lg-between justify-content-center mx-0">
                            <div class="col-xl-4 col-lg-5 mr-xl-5 pt-5 pt-md-0 mt-5 mt-md-0">
                                <div class="oveflow-wrapper">
                                    <h1 data-caption-animate="fadeInUp" data-caption-delay="500" class="fadeInUp animated dima">درمانگاه شبانه روزی لاوین</h1>
                                </div>
                                <div class="oveflow-wrapper">
                                    <h5 class="big text-accent fadeInUp animated" data-caption-animate="fadeInUp" data-caption-delay="400">به مدیریت دکتر علی‌اکبر جعفری</h5>
                                </div>
                                <p data-caption-animate="fadeInUp" data-caption-delay="600" class="fadeInUp animated"> کلینیک لاوین یکی از بهترین مراکز درمانی در حوزه پوست، مو و زیبایی در رشت و ایران می باشد، که دارای مجوز
                                    رسمی از وزارت بهداشت، درمان و آموزش پزشکی با مدیریت آقای دکتر علی جعفری می باشد که در جهت ارائه خدمات مطلوب، موثر و ماندگار در حوزه پوست، لیزر و زیبایی فعالیت می کند.
                                <ul class="group text-xs-nowrap">
                                    <li><a class="button button-black fadeInUp animated" href="{{ route('website.about') }}" data-caption-animate="fadeInUp" data-caption-delay="500">بیشتر</a></li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-xl-7 col-lg-6 video-caption-wrapper">
                                <div class="video-caption"><img class="video-caption-overlay" src="/images/front/laptop.png" alt="">
                                    <!-- RD Video-->
                                    <div class="rd-video rd-video-player" data-rd-video-path="/video/monstroid">
                                        <div class="rd-video-wrap">
                                            <div class="rd-video-preloader"></div>
                                            <video style="visibility: visible; opacity: 1;" controls __idm_id__=""><source type="video/mp4" src="/video/monstroid.mp4"></video>
{{--                                            <div class="rd-video-controls">--}}
{{--                                                <!-- Play\Pause button--><a class="rd-video-play-pause mdi mdi-play icon icon-lg" href="#"></a>--}}
{{--                                                <!-- Progress bar-->--}}
{{--                                                <div class="rd-video-progress-bar">--}}
{{--                                                    <div class="current" style="width: 0%;"></div>--}}
{{--                                                    <div class="current" style="width: 26.3415%;"></div></div>--}}
{{--                                                <div class="rd-video-time">--}}
{{--                                                    <!-- currentTime--><span class="rd-video-current-time">00:19</span> ---}}
{{--                                                    <!-- Track duration--><span class="rd-video-duration">01:15</span>--}}
{{--                                                </div>--}}
{{--                                                <div class="rd-video-volume-wrap">--}}
{{--                                                    <!-- Volume button--><a class="rd-video-volume mdi mdi-volume-high icon icon-sm" href="#"></a>--}}
{{--                                                    <div class="rd-video-volume-bar-wrap">--}}
{{--                                                        <!-- Volume bar-->--}}
{{--                                                        <div class="rd-video-volume-bar rd-video-volume-bar-vertical"><div class="current" style="width: 100%; height: 20%;"></div></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            <div class="swiper-slide" data-slide-bg="/images/000/home-slider-03.jpg" style="background-image: url('/images/000/home-slider-03.jpg'); background-size: cover; width: 1349px;">--}}
{{--                <div class="swiper-slide-caption">--}}
{{--                    <div class="container container-wide">--}}
{{--                        <h2 data-caption-animate="fadeInUp" data-caption-delay="300" class="not-animated">A Variety of Available Customization Options</h2>--}}
{{--                        <ul class="group text-xs-nowrap">--}}
{{--                            <li><a class="button button-white not-animated" href="../62267-default" data-caption-animate="fadeInUp" data-caption-delay="500">Live demo</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <!-- Swiper Navigation-->
{{--        <div class="swiper-button-prev mdi mdi-chevron-left swiper-button-disabled"></div>--}}
{{--        <div class="swiper-button-next mdi mdi-chevron-right"></div>--}}
        </section>

        <div class="col-12 px-xl-5 text-right pt-5 pb-5">
            <h2 class="dima heading-4 text-dark px-xl-5"> خدمات لاوین</h2>
            <div class="mt-3 px-xl-5">با انتخاب هر کدام از خدمات با جزئیات بیشتر آشنا میشوید. امکان ثبت سفارش دریافت خدمات در وبسایت لاوین برای شما امکان پذیر می باشد. </div>
            <div class="col-md-12 row mx-0 mt-4 py-4">
               @foreach($allservices as $service)
                <div class="col-12 col-md px-2" style="min-width: 230px" data-aos-delay="0" data-aos="fade-up" data-aos-anchor-placement="top-center">
                    @include('includes.elements.service-card', [ 'name' => $service->name,'desc'=>$service->desc,'details'=>$service->details,'image' =>$service->get_thumbnail('thumbnail')])
                </div>
                @endforeach

            </div>
            <div class="col-12 d-flex justify-content-center pb-5 mt-2">
                <a href="{{ route('website.services.index') }}" class="col-md-3 button button-black small">دیدن تمام خدمات لاوین و سفارش خدمات</a>
            </div>
        </div>

    </div>

    <!-- @include('includes.home-slider') -->

    @include('includes.home-shop')

    @include('includes.home-doctors')

    @include('includes.home-lottery')

    @include('includes.home-blog')

    @include('includes.home-gallery')

@stop

@push('css')
    <style>
        .page{
            min-height: 100vh !important;
            overflow: hidden;
        }
        .mega-menu{
            padding-top: 43px;
        }
        @media screen and (min-width: 1400px) {
            .page video{

            }
        }
        @media screen and (min-width: 1400px) {
            .page h1{
                line-height: 2;
            }
        }
    </style>
@endpush
