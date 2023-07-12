@extends('layouts.master')

@section('content')
    @include('layouts.header')
    <div class="col-12 text-right px-0 px-md-3">
        <div class="container">
            <div class="b-crumb col-12 small my-4">
                <a href="/" class="text-muted">خانه</a>
                <i class="fa fa-chevron-left px-2"></i>
                <a href="#" class="text-muted">نمونه کارها</a>
                <i class="fa fa-chevron-left px-2"></i>
                <span class="text-black">{{ $portfolio->title }}</span>
            </div>
            <div class="col-12 mx-0 row px-0 px-md-3">
                <div class="col-md-4 px-0">
                    <h1 class="h6 dima mb-3">{{ $portfolio->title }}</h1>
                    <div class="text-dark mb-3 text-justify">
                    {{ $portfolio->descriotion }}
                    </div>
                    <hr class="py-2">
                    <div class="mb-4">
                        <img src="/images/000/d2.png" class="rounded-circle pl-2" width="60" height="60" alt="">
                        <span style="font-size:11px;">دکتر عباس مرادی فوق تخصص فیزیوتراپی</span>
                    </div>
                </div>
                <div class="col-md-8 px-1 px-xl-5 mb-5">
                    <div class="position-sticky" style="top:7rem">

                        <div class="slide-container w-100 text-center" dir="ltr">
                            <figure>
                                <div id="compare"></div>
                            </figure>
                            <input oninput="beforeAfter()" onchange="beforeAfter()" type="range" min="0" max="100" value="50" id="slider"/>
                        </div>

                        @if($portfolio->video != null)
                        <div class="col-12 text-center my-4 px-0">
                            <video poster="@if($portfolio->poster_img!=null){{ $portfolio->poster_img->getImagePath('medium') }} @endif" class="w-100" controls>
                            <source src="{{ $portfolio->video }}" type="video/mp4">
                            <source src="{{ $portfolio->video }}" type="video/ogg">
                             Your browser does not support HTML video.
                            </video>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="/css/before-after-slide.css">
    <style>
        /*right image*/
        .slide-container figure {
            @if($portfolio->before_img != null)
            background-image: url('{{ $portfolio->before_img->getImagePath("medium") }}');
            @else
            background-image: url('');
            @endif
        }
        /*left image*/
        #compare {
            @if($portfolio->after_img != null)
            background-image: url('{{ $portfolio->after_img->getImagePath("medium") }}');
            @else
            background-image: url('');
            @endif
        }
    </style>
@endpush

@push('js')
    <script>
        // Code By Webdevtrick ( https://webdevtrick.com )
        function beforeAfter() {
            document.getElementById('compare').style.width = document.getElementById('slider').value + "%";
        }
    </script>
@endpush
