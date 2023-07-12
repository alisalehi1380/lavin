<a href="{{ route('website.shop.products.show',$slug) }}">
    <div class="bg-light rounded-xl position-relative">
        @if($special==true && $specialDateTime>Carbon\Carbon::now()->format('Y-m-d H:i:s'))
        <img src="{{ url('/') }}/images/front/svg/spacial.svg" width="52px" class="spacial-bubble" style="z-index: 2;">
        @endif
{{--        @if(count($secondImage)>0)--}}
{{--        <img src="{{ $secondImage[0]->getImagePath('medium') }}" class="w-100 rounded-top-xl">--}}
{{--        @endif--}}
{{--        <img src="{{ $thumbnail }}" class="hover-fade-out w-100 rounded-top-xl position-absolute" style="top: 0;right: 0;">--}}


        {{-- second image--}}
        @if(count($secondImage)>0)
        <img src="{{ $secondImage[0]->getImagePath('medium') }}" class="w-100 rounded-top-xl position-absolute" style="top: 0;right: 0;z-index: 0">
        @endif
        {{-- first image--}}
        <img src="{{ $thumbnail }}" class="w-100 rounded-top-xl position-relative @if(count($product->images)>0) hover-fade-out @endif" style="z-index: 1;">


        <div class="px-3 pb-3 text-center">
            <small class="text-dark text-truncate">{{ $name }}</small>
            @if($special==true && $specialDateTime>Carbon\Carbon::now()->format('Y-m-d H:i:s'))
            <small class="text-muted"><s data-price="">{{ $price }}</s> تومان</small>
            <span class="text-info"><span data-price="">{{ $specialPrice }}</span> تومان</span>
            @else
            <small class="text-light"><s data-price=""></s></small>
            <span class="text-info"><span data-price="">{{ $price }}</span> تومان</span>
            @endif
        </div>
        <div class="position-absolute leaf-shadow"></div>
    </div>
</a>
<div class="w-100 text-left" >
    <a href="#" class="position-relative" style="top: -32px;left: 8px" title="افزودن به سبد خرید">
        <i class="fa fa-cart-plus fa-xs text-accent"></i>
    </a>
</div>

