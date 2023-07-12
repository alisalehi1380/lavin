@extends('layouts.master')

@section('content')
    <div class="gallery-background">
        @include('layouts.header')
        <div class="px-lg-5">
            <h1 class="h4 dima text-pink text-center">گالری تصاویر لاوین</h1>
            <div class="b-crumb col-12 small my-4">
                <a href="/" class="text-muted">خانه</a>
                <i class="fa fa-chevron-left px-2"></i>
                <span class="text-black">گالری تصاویر</span>
            </div>

            <div class="col-12 pl-1 pr-0 px-lg-5 pb-4 row mx-0 row mx-0">
                @foreach($galleries as $gallery)
                <div class="col-4 col-xl-3 pl-0 pr-1 px-md-3 mt-4 lgallery">
                    <a class="pointer thumb-modern item" data-src="{{ $gallery->images[0]->getImagePath('medium') }}">
                        <figure class="rounded mb-0">
                            <img src="{{ $gallery->images[0]->getImagePath('medium') }}" title="{{ $gallery->images[0]->title }}" alt="{{ $gallery->images[0]->alt }}" width="100%">
                        </figure>
                        <div class="col-12 row mx-0 px-1">
                            <div class="col-md-7 px-0 text-truncate">{{ $gallery->name }}</div>
                            <div class="col px-0"><span class="bg-accent rounded small d-inline px-2 py-0 mt-1 float-left">{{ count($gallery->images) }}مورد</span></div>
                        </div>
                    </a>
                    @foreach($gallery->images as $index=>$image)
                        @if($index>0)
                        <span class="item d-none" data-src="{{ $image->getImagePath('medium') }}"><img src="{{ $image->getImagePath('medium') }}"></span>
                        @endif
                    @endforeach
                </div>
                @endforeach
            </div>


            <div class="d-flex text-center justify-content-center pb-5">
                <div class="pagination border">
                     {!! $galleries->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
    <link rel="stylesheet" href="/light-gallery/css/lightgallery.css">
    <style>
        .thumb-modern img{
            transition: all .2s;
        }
        .thumb-modern img:hover{
            transform: scale(1.1);
        }
        .thumb-modern figure{
            overflow: hidden;
            border: 1px solid gray;
        }
        .gallery-background{
            background-image: url("/images/front/background-1.jpg");
            background-size: cover;
        }
        .thumb-modern .bg-accent{
            background-color: white !important;
            color: #2ed3ae !important;
            border: 2px solid #2ed3ae;
        }
    </style>
@endpush

@push('js')
    <script src="/light-gallery/js/lightgallery-all.js"></script>
    <script>
        $(document).ready(function () {
            $('.lgallery').lightGallery({
                thumbnail: true,
                selector: '.item'
            });
        });
    </script>
@endpush
