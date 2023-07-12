<div id="visit-bg" >
    <div class="container" style="padding-bottom: 80px;">
        <div class="col-12 px-0 row mx-0">
            <div class="col-md-5 mt-5">

                <div class="px-3 mb-4">
                    <h2 class="dima heading-4 text-dark">مشاوره و ویزیت</h2>
                    <div class="mt-3">ثبت مشاوره آنلاین یا درخواست ویزیت در منزل</div>
                    <p class="text-muted small my-0 text-justify">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی</p>
                    <div class="w-100 text-center">
                        <a href="/visit/advice" class="button btn-accent-outline p-2 mt-2">درخواست مشاوره</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-none d-md-flex py-4 my-auto">
                <img src="/images/000/eq6xdisv.png" data-aos="zoom-out-right" width="100%" alt="">
            </div>
            <div class="col-md-3 d-none d-md-flex py-4 my-auto">
                <img src="/images/000/hoxv9w68.png" data-aos="zoom-out-right" width="100%" alt="">
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        $(document).ready(function(){
            $(".home-slider.owl-carousel").owlCarousel({
                rtl:true,
                items:1,
                loop:true,
                dots:false,
                navText : ["<i></i>","<i></i>"]
            });
        });
    </script>
@endpush

@push('css')
    <style>
        .home-slider .owl-prev,.home-slider .owl-next{
            top: 108%;
            margin-right: 3rem;
        }
        .home-slider .owl-prev{
            left: unset;
            right:5px
        }
        #visit-bg{
            background-image: url("/images/front/background-1.jpg");
            background-size: cover;
        }
    </style>
@endpush
