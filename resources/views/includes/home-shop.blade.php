<section class="section-xl">
    <section class="section parallax-container context-dark" data-parallax-img="/images/front/cover-parallax.png">
        <div class="parallax-content">
            <div class="px-0 px-md-5 pb-5 pt-3">
                <h2 class="heading-3 text-center dima" data-aos="fade-up" data-aos-delay="800">فروشگاه لاوین</h2>
                <p class="text-center mt-4" data-aos="fade-up" data-aos-delay="900">جهت دیدن تمامی محصولات ما با جزئیات بیشتر بر روی دکمه دیدن همه محصولات کلیک کنید</p>
                <div class="col-12 row mx-0 text-right py-3 px-0 px-md-3 shop-slider owl-carousel">

                    @foreach($products as $product)

                    <div class="col mb-3 pt-4 px-1 px-md-2" data-aos="fade-in" data-aos-delay="{{ $loop->iteration * 120 }}"
                         data-aos-duration="1000" style="max-width: 340px">
                    @include('includes.elements.product-card',
                     [
                        'thumbnail' => $product->get_thumbnail('medium'),
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'specialPrice' => $product->specialPrice,
                        'special' => $product->special,
                        'specialDateTime' => $product->specialDateTime,
                        'secondImage' => $product->images,
                     ])
                    </div>
                    @endforeach

                </div>
                <div class="text-center mt-4">
                    <a class="button button-black" href="{{ route('website.shop.products.index') }}">دیدن همه محصولات</a>
                </div>
            </div>
        </div>
    </section>
</section>

@push('js')
    <script>
        $(document).ready(function(){
            $(".shop-slider.owl-carousel").owlCarousel({
                rtl:true,
                items:5,
                loop:true,
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
    </script>
@endpush

@push('css')
    <style>
        @media (max-width:1000px) {
            .owl-nav{
                display: none;
            }
            .owl-carousel .owl-item {
                display: flex;
                justify-content: center;
            }
        }
    </style>
@endpush
