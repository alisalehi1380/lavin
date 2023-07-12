@extends('layouts.master')

@section('content')
    <div id="service">
        @include('layouts.header')
        <div class="row mx-0 col-12 px-0 px-xl-5 pb-3">
            <div class="col-md-3" dir="ltr">
                @if($product->images != null)
                    <div class="outer">
                        <div id="big" class="owl-carousel owl-theme lgallery">
                            @foreach($product->images as $image)
                            <div class="item pointer" data-src="{{ $image->getImagePath('medium') }}">
                                <img src="{{ $image->getImagePath('medium') }}" class="w-100 rounded" title="{{ $image->title }}" alt="{{ $image->title }}">
                            </div>
                            @endforeach
                        </div>

                        <div id="thumbs" class="owl-carousel owl-theme">
                            @foreach($product->images as $image)
                            <div class="item">
                                <img src="{{ $image->getImagePath('thumbnail') }}" class="w-100"  title="{{ $image->title }}" alt="{{ $image->alt }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <h1 class="h4 dima text-center text-md-right mt-3 mt-md-0">{{ $product->name ?? "" }}</h1>
                <div class="mt-4">
                    <span class="badge badge-secondary rounded shadow-sm px-2 ml-1">{{ $product->parent_cat->name ?? "" }}</span>
                    <span class="badge badge-secondary rounded shadow-sm px-2">{{ $product->child_cat->name ?? ""}}</span>
                </div>
                <p class="mt-1 pl-0 pl-xl-5 text-justify">{{ $product->description ?? ""}}</p>
            </div>

            <div class="col-md-4 text-dark">


                <div class="px-xl-4">
                    @if($product->special==true && $product->specialDateTime >Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                    <div class="rounded text-left">
                        <span style="min-width:160px;border:2px solid rgba(255,0,0,0.58);background-color: rgba(255,0,0,0.07)" class="rounded text-center py-2 text-danger d-inline-block h6  position-relative px-3">
                            <p id="timer"></p>
                        </span>
                        <img src="/images/front/svg/spacial.svg" width="52px" class="spacial-bubble" style="z-index: 2;">
                    </div>
                    @endif

                    <div class="rounded small p-2 mb-3 text-center"
                         style="border:2px solid #dadada;background-color: rgba(255,255,255,0.45)"><i class="fa fa-exclamation-triangle px-2 text-danger"></i> تنها  {{ $product->stock }} عدد باقی مانده</div>

                    <div class="rounded col-12 py-3" style="border:2px solid #2ed3ae;background-color: rgba(255,255,255,0.45)">

                        <div> قیمت کالا&nbsp;(تومان)</div>

                        @if($product->special==true && $product->specialDateTime >Carbon\Carbon::now()->format('Y-m-d H:i:s'))
                        <small class="text-center"><s><span data-price="true">{{ $product->price }}</span> تومان</s></small>
                        <div class="text-center h3" data-price="true">{{ $product->specialPrice }}تومان</div>
                        @else
                        <div class="text-center h3" data-price="true">{{ $product->price }}</div>
                         @endif

                        <div class="col-12 text-center mt-3">
                            <a href="{{ route('website.shop.cart.add2cart',$product) }}" class="button bg-accent border-0 text-white py-2 pointer" >افزودن به سبد</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @if($product->attributes!=null)
    <div class="container">
        <div class="col-12 row mx-0 pt-5">
            <h4 class="w-100 text-center mb-3">ویژگی‌ها</h4>
            @foreach(json_decode($product->attributes,true) as $key=>$value)
            <div class="col-12 text-dark row mx-0 mt-0 bg-light py-2">
                <div class="col-3">{{ $key }}</div>
                <div class="col-9">{{ $value }}</div>
            </div>
            @endforeach

        </div>
    </div>
    @endif

        <div class="col-12 my-5 bg-light py-4">
            <h4 class="text-center dima">دیگر محصولات</h4>
            <div class="col-12 row mx-0 justify-content-center mt-5 shop-slider owl-carousel">
                @foreach($others as $other)
                    <div class="col mb-3 pt-4 px-1 px-md-2" data-aos="fade-in" data-aos-delay="{{ $loop->iteration * 120 }}"
                        data-aos-duration="1000" style="max-width: 340px">
                        @include('includes.elements.product-card',
                        [
                            'thumbnail' => $other->get_thumbnail('medium'),
                            'name' => $other->name,
                            'slug' => $other->slug,
                            'price' => $other->price,
                            'specialPrice' => $other->specialPrice,
                            'special' => $other->special,
                            'specialDateTime' => $other->specialDateTime,
                            'secondImage' => $other->images,
                        ])
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>

    <div class="col-12 my-5">

        <div class="container">

            <div class="row col-12 mx-0 mb-5">
                <div class="col-12 col-md-2">
                    <a @auth href="#review-modal" @else href="#loginModal" @endauth
                       data-toggle="modal" class="btn btn-accent-outline d-block mb-5 mb-md-0 shadow"><i class="fa fa-plus-circle"></i> ثبت نظر من</a>
                </div>
                <h4 class="col-md-8 text-center dima">نظرات و بازخوردها</h4>
            </div>

            @if($product->reviews !=null)
                 @foreach($product->reviews as $review)
                <div class="col-12 shadow bg-light-grey my-2 mb-3 rounded-xl row mx-0" dir="rtl">
                    <div class="col-md-3 pb-2 pl-0 small">
                        <div class="mt-3 pl-2 text-muted" style="border-left:1px solid #c9c9c9">امتیاز کاربر</div>

                        @foreach(json_decode($review->reviews,true) as $key=>$value)
                        <div class="col-12 pt-2 pb-2 px-0 row mx-0 mt-0" style="border-left:1px solid #c9c9c9">
                            <div class="col-5 text-dark">{{ $key }}</div>
                            <div class="col-7 text-right text-nowrap">
                                @for($i=0;$i<=$value;++$i)
                                <i class="fa fa-star text-warning"></i>
                                @endfor
                            </div>
                        </div>
                        @endforeach


                    </div>
                    <div class="col-md-9 pt-3">
                        <img class="rounded-circle" src="{{ Gravatar::get( $review->user->email()) }}" alt="{{ $review->user->firstname.' '.$review->user->lastname }}" title="{{ $review->user->firstname.' '.$review->user->lastname }}" width="50px">
                        <b class="h5">{{ $review->user->firstname.' '.$review->user->lastname }}</b>
                        <div class="text-secondary float-left small">{{ $review->date() }} </div>
                        <p class="p-1 mb-1 text-dark">{{ $review->content }}</p>
                    </div>
                </div>
                @endforeach
            @endif

        </div>

        <div class="modal" id="review-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content border-0">
                    <div class="modal-header justify-content-center  py-3">
                        <h5 class="modal-title fw-bold">به نظر من ...</h5>
                    </div>
                    <form action="{{ route('website.shop.products.reviwe',$product) }}" method="post">
                        @csrf
                        <div class="modal-body py-0">
                            <div class="col-12 my-2 row mx-0">
                                <div class="col-lg-3 order-1 order-lg-0 pb-2 pr-0">
                                    <div class="pr-2 text-muted small pb-2">امتیازدهید:</div>
                                        @foreach($reviewGroups as $reviewGroup)
                                        <div class="col-12 pt-2 pb-2 px-0 row mx-0 mt-0">
                                            <div class="col-3  text-dark small">{{ $reviewGroup->title  }}</div>
                                            <div class="col-9  text-nowrap review-rating">
                                                <i class="fa fa-star position-relative" data-tooltip="1" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                <i class="fa fa-star position-relative" data-tooltip="2" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                <i class="fa fa-star position-relative" data-tooltip="3" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                <i class="fa fa-star position-relative" data-tooltip="4" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                                <i class="fa fa-star position-relative" data-tooltip="5" onclick="changeRate(this)" onmousemove="changeStarColor(this)" onmouseout="removeStarColor(this)"></i>
                                            </div>
                                            <input type="hidden" name="{{ $reviewGroup->title  }}">
                                        </div>
                                        @endforeach

                                    </div>
                                <div class="col-lg-9 order-0 order-lg-1 my-3 smart-border">

                                    <div class="text-muted small pt-1">توضیحات</div>
                                    <div>
                                        <textarea rows="3" class="form-control w-100 px-2 mb-3 mt-1" name="content" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center border-top-0 px-0 pt-1">
                            <button type="button" class="btn pointer btn-light text-secondary rounded border px-5" id="close-review-modal" data-dismiss="modal">انصراف</button>
                            <button class="btn btn-accent-outline px-4 pointer mr-1"  type="submit">ارسال دیدگاه</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>

@stop

@push('js')
    <script src="/light-gallery/js/lightgallery-all.js"></script>
    <script>


    var countDownDate = new Date("{{ $product->specialDateTime }}").getTime();

    var x = setInterval(function() {

    var now = new Date().getTime();

    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = days + " روز " + hours + ":"+ minutes + ":" + seconds;


    if (distance < 0)
    {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "منقضی شد";
    }
    }, 1000);


        $(document).ready(function() {

            $('.lgallery').lightGallery({
                thumbnail: true,
                selector: '.item'
            });


            var bigimage = $("#big");
            var thumbs = $("#thumbs");
            //var totalslides = 10;
            var syncedSecondary = true;

            bigimage
                .owlCarousel({
                    items: 1,
                    slideSpeed: 2000,
                    nav: false,
                    autoplay: true,
                    dots: false,
                    loop: true,
                    responsiveRefreshRate: 200,
                    navText: [
                        '<i></i>',
                        '<i></i>'
                    ]
                })
                .on("changed.owl.carousel", syncPosition);

            thumbs
                .on("initialized.owl.carousel", function() {
                    thumbs
                        .find(".owl-item")
                        .eq(0)
                        .addClass("current");
                })
                .owlCarousel({
                    items: 4,
                    dots: false,
                    nav: false,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: 4,
                    responsiveRefreshRate: 100
                })
                .on("changed.owl.carousel", syncPosition2);

            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;

                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                    .find(".owl-item.active")
                    .first()
                    .index();
                var end = thumbs
                    .find(".owl-item.active")
                    .last()
                    .index();

                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }

            thumbs.on("click", ".owl-item", function(e) {
                e.preventDefault();
                var number = $(this).index();
                bigimage.data("owl.carousel").to(number, 300, true);
            });

            $(".shop-slider.owl-carousel").owlCarousel({
                rtl:true,
                items:5,
                loop:false,
                autoplay:true,
                dots:false,
                autoplaySpeed: 3000,
                autoplayHoverPause: true,
                nav:true,
                navText : ["<i></i>","<i></i>"],
                responsive : {
                    // breakpoint from 0 up
                    0 : {
                        items:1,
                        margin: 5,
                        stagePadding: 50
                    },
                    // breakpoint from 480 up
                    530 : {
                        items:3,
                    },
                    // breakpoint from 768 up
                    1200 : {
                        items:5,

                    }
                }
            });
        });

        function changeRate(star) {
            let stars = star.parentElement.children;
            let input = star.parentElement.nextElementSibling;
            let value = star.dataset.tooltip;
            $.map(stars, function (item) {
                $(item).removeClass("text-warning-force");
            });
            for (let i = 0; i < value; i++) {
                $(stars[i]).addClass("text-warning-force");
            }
            input.value = value;
        }
        function changeStarColor(star) {
            let stars = star.parentElement.children;
            let value = star.dataset.tooltip;
            for (let i = 0; i < value; i++) {
                $(stars[i]).addClass("text-warning");
            }
        }
        function removeStarColor(star) {
            let stars = star.parentElement.children;
            $.map(stars, function (item) {
                $(item).removeClass("text-warning");
            });
        }
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="/light-gallery/css/lightgallery.css">
    <style>
        #service{
            background-image: url("/images/front/service-bg.jpg");
            background-size: 100%;
        }
        @media (max-width: 768px) {
            #service{
                background-size: auto 100%;
            }
        }

        #review-modal .smart-border {
            border-right-style: dashed;
        }
        .smart-border {
            border-right: 1px solid #c9c9c9;
            border-right-style: solid;
        }

        @media (max-width: 768px) {
            #review-modal .smart-border {
                border: none;
                border-bottom-color: currentcolor;
                border-bottom-style: none;
                border-bottom-width: medium;
                border-bottom: 1px dashed #c9c9c9;
            }
        }

        .owl-dots,.owl-nav.disabled{ display: none}

        .outer { margin:0 auto; max-width:800px;}
        #big .item { padding: 10px 0; margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
        #thumbs .item { background: #C9C9C9; height:72px; line-height:70px; padding: 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; cursor: pointer; }
        #thumbs .current .item { background:mediumaquamarine; padding:2px; }
        .owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
        .owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
        #big.owl-theme { position: relative; }
        #big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#333; width: 22px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
        #big.owl-theme .owl-prev { left: 10px; }
        #big.owl-theme .owl-next { right: 10px; }
        #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { background:#333; }
    </style>
@endpush
