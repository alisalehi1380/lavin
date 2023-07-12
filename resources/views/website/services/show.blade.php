@extends('layouts.master')

@section('content')
    <div id="service">
        @include('layouts.header')
        <div class="row mx-0 col-12 px-0 px-xl-5 pb-3">
            <div class="col-md-3" dir="ltr">
                @if($service->images != null)
                <div class="outer">
                    <div id="big" class="owl-carousel owl-theme">
                        @foreach($service->images as $image)
                        <div class="item">
                            <img src="{{ $image->getImagePath('medium') }}" class="w-100 rounded" title="{{ $image->title }}" alt="{{ $image->alt }}">
                        </div>
                        @endforeach
                    </div>

                    <div id="thumbs" class="owl-carousel owl-theme">
                        @foreach($service->images as $image)
                        <div class="item">
                            <img src="{{ $image->getImagePath('thumbnail') }}" class="w-100"  title="{{ $image->title }}" alt="{{ $image->alt }}">
                        </div>
                        @endforeach
                    </div>

                </div>
                @endif
            </div>
            <div class="col-md-5">
                <h1 class="h3 dima text-center text-md-right mt-3 mt-md-0">{{ $service->name }}</h1>
                <div class="mt-4">
                    <span class="badge badge-secondary rounded shadow-sm px-2 ml-1">دهان و دندان</span>
                    <span class="badge badge-secondary rounded shadow-sm px-2">ترمیم دندان</span>
                </div>
                <p class="mt-1 pl-0 pl-xl-5">{{ $service->breif }}</p>
                <div class="h4 text-accent text-center text-md-right"><span data-price="true">2600000</span>  تومان</div>
            </div>
            <div class="col-md-4 text-dark">

                <div class="px-xl-4">
                    <div class="rounded small p-2 mb-1"
                         style="border:2px solid #dadada;background-color: rgba(255,255,255,0.45)">امتیاز استفاده از این سرویس <span class="text-accent px-1 font-weight-bold">{{ $service->point }}</span> می‌باشد.</div>

                    <div class="rounded small p-2 mb-3"
                         style="border:2px solid #dadada;background-color: rgba(255,255,255,0.45)">امتیاز معرفی این سرویس <strong class="px-1">{{ $service->porsant }}</strong>می‌باشد.</div>

                    <form class="rounded col-12 py-3" style="border:2px solid #2ed3ae;background-color: rgba(255,255,255,0.45)" method="POST" action="{{ route('website.services.reserve',[$service->service,$service]) }}">
                        @csrf
                        <div>انتخاب پزشک</div>
                        <div>
                            <select name="doctor_id" class="custom-select small w-100">
                               <option disabled selected>نام پزشک را انتخاب کنید</option>
                               @foreach($service->doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->fullname }}</option>
                               @endforeach
                            </select>
                        </div>
                        <div class="col-12 text-center mt-3">
                            @auth
                                <input type="submit" class="button bg-accent border-0 text-white py-2 pointer" value="رزرو نوبت">
                            @else
                                <a href="#loginModal" data-toggle="modal" class="button bg-accent border-0 text-white py-2">رزرو نوبت</a>
                            @endauth
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="col-12 row mx-0 pt-5">
            <div class="col-md-5">
                <h4>توضیحات</h4>
                <p class="text-black">{{ $service->desc }}</p>
            </div>
            <div class="col-md-7">
                @if($service->videos!=null)
                @foreach($service->videos as $video)
                <video src="{{ $video->link }}" controls class="w-100 rounded-xl" @if($video->poster!=null) poster="{{ $video->poster->getImagePath('large') }}"  @endif></video>
                @endforeach
                @endif
            </div>

        </div>
    </div>

    <div class="col-12 my-5 bg-light py-4">
        <h4 class="text-center dima">دیگر خدمات</h4>

        <div class="col-12 row mx-0 justify-content-center mt-5">
            @foreach($service->service->details as $detail)
            <div class="text-center px-1 mb-3 mb-md-5">
                <a href="">
                    <span class="btn-accent-outline text-nowrap rounded font-weight-light px-5 py-1 mr-1 mb-1">{{ $detail->name }}</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-12 my-5">

        <div class="container">

            <div class="row col-12 mx-0 mb-5">
                <h4 class="col-12 text-center dima">نظرات و بازخوردها</h4>
            </div>
            @if($service->reserves!=null)
                @foreach($service->reserves as $reserve)
                    @if($reserve->review !=null)
                        <div class="col-12 shadow bg-light-grey my-2 mb-3 rounded-xl row mx-0" dir="rtl">
                            <div class="col-md-3 pb-2 pl-0 small">
                                <div class="mt-3 pl-2 text-muted" style="border-left:1px solid #c9c9c9">امتیاز کاربر</div>

                                @foreach(json_decode($reserve->review->reviews,true) as $key=>$value)
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
                                <img class="rounded-circle" src="{{ Gravatar::get( $reserve->user->email()) }}" alt="{{ $reserve->user->firstname.' '.$reserve->user->lastname }}" title="{{ $reserve->user->firstname.' '.$reserve->user->lastname }}" width="50px">
                                <b class="h5">{{ $reserve->user->firstname.' '.$reserve->user->lastname }}</b>
                                <div class="text-secondary float-left small">{{ $reserve->review->date() }} </div>
                                <p class="p-1 mb-1 text-dark">{{ $reserve->review->content }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

    </div>

@stop

@push('js')
    <script>
        $(document).ready(function() {
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
