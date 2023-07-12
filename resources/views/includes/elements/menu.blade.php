<header class="page-header">
    <!-- RD Navbar-->
    <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-default rd-navbar-original rd-navbar-static">
            <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                    <!-- RD Navbar Toggle-->
                    <button class="rd-navbar-toggle toggle-original" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                    @auth
                        <div class="dropdown d-inline">
                                <span class="py-2 d-sm-none dropdown-toggle pointer small d-inline" id="dropdownMenuButton" data-toggle="dropdown">
                                    <img src="/images/front/user.png" class="rounded-circle border ml-1" width="35" height="35">
                                    <span class="text-truncate d-inline-block" style="max-width: 57px;margin-bottom: -11px;">{{ auth()->user()->firstname.' '.auth()->user()->lastname }}</span>
                                </span>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item small" href="{{ route('website.account.dashboard') }}">پنل مشتری</a>
                                <a class="dropdown-item small" href="#">سبدخرید</a>
                                <a class="dropdown-item small" href="{{ route('website.logout') }}">خروج</a>
                            </div>
                        </div>
                    @else
                        <a class="d-sm-none" href="#loginModal" data-toggle="modal">ورود</a>
                    @endauth
                <!-- RD Navbar Brand-->
                    <div class="rd-navbar-brand mr-auto mr-md-0"><a class="brand-name" href="{{ route('website.index') }}"><img src="/images/front/logo.png" alt="لاوین" @if(Route::currentRouteName() == 'website.index') id="lavin-logo" height="33" @else style="height: 50px" @endif></a></div>
                </div>
                <div class="rd-navbar-aside-right">
                    <div class="rd-navbar-nav-wrap toggle-original-elements">
                        <!-- RD Navbar Nav-->
                        <ul class="rd-navbar-nav">
                            <li class="d-xs-block"><a href="{{ route('website.search') }}" dir="ltr"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="28" viewBox="0 0 34.785 32.532"><g fill="none" stroke="#fff" stroke-width="4"><circle cx="15.5" cy="15.5" r="15.5" stroke="none"/><circle cx="15.5" cy="15.5" r="13.5" fill="none"/></g><path d="M83.3,78.5l7.79,7.191" transform="translate(-58 -55)" fill="none" stroke="#fff" stroke-width="5"/></svg></a></li>
                            <li class="active"><a href="{{ route('website.index') }}">خانه</a></li>
                            <li><a href="{{ route('website.portfolios.index') }}">نمونه کارها</a></li>
                            <li><a href="{{ route('website.articles.blog') }}">مقالات</a></li>
                            <li><a onclick="show_mega_menu('service-mm')" class="pointer">خدمات <span class="position-relative" style="top:7px">🢓</span></a></li>
                            <li><a onclick="show_mega_menu('product-mm')" class="pointer">فروشگاه محصولات<span class="position-relative" style="top:7px">🢓</span></a></li>
                            <li><a href="{{ route('website.faq') }}">سئوالات متداول</a></li>
                            <li><a href="{{ route('website.contact') }}">تماس باما</a></li>
                            <li><a href="{{ route('website.about') }}">درباره‌ما</a></li>
                            <li><a href="{{ route('website.lottery.index') }}">گردونه شانس</a></li>
                            @auth
                                @if($noteFicationCount>0)
                                <li class="d-xs-block position-relative">
                                    <a href="{{ route('website.account.notifications.index') }}">اعلان پیام ها<svg class="position-absolute"
                                                                                                                style="right: 14px;top: 7px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="25" viewBox="0 0 30 28">
                                            <defs>
                                                <filter id="Ellipse_30" x="9.27" y="-6.157" width="28" height="28" filterUnits="userSpaceOnUse">
                                                    <feOffset dy="1" input="SourceAlpha"/>
                                                    <feGaussianBlur stdDeviation="3" result="blur"/>
                                                    <feFlood flood-color="#2ed3ae"/>
                                                    <feComposite operator="in" in2="blur"/>
                                                    <feComposite in="SourceGraphic"/>
                                                </filter>
                                                <clipPath id="clip-bell0">
                                                    <rect width="30" height="28"/>
                                                </clipPath>
                                            </defs>
                                            <g clip-path="url(#clip-bell0)">
                                                <g id="bell-2" data-name="bell" transform="translate(-1.73 2.305)">
                                                    <g id="Path_105" data-name="Path 105" transform="translate(6.184 -0.573)" fill="none">
                                                        <path d="M7.106,0c4.488,0,7.5,4.338,7.5,9.69s8.687,9.69-7.5,9.69S-.4,15.041-.4,9.69,2.617,0,7.106,0Z" stroke="none"/>
                                                        <path d="M 7.105806350708008 2.999996185302734 C 5.907346725463867 2.999996185302734 4.886715888977051 3.550905227661133 4.072296142578125 4.637415885925293 C 3.125495910644531 5.900515556335449 2.604076385498047 7.694795608520508 2.604076385498047 9.689735412597656 C 2.604076385498047 11.93096542358398 1.678446769714355 13.80394554138184 0.9346961975097656 15.30890560150146 C 0.8435497283935547 15.49333190917969 0.7351474761962891 15.71267890930176 0.6323823928833008 15.92929935455322 C 0.884730339050293 15.98550987243652 1.202656745910645 16.04427719116211 1.599706649780273 16.09959602355957 C 2.932736396789551 16.28530502319336 4.785256385803223 16.37947463989258 7.105806350708008 16.37947463989258 C 9.426356315612793 16.37947463989258 11.27887630462646 16.28530502319336 12.61190605163574 16.09959602355957 C 13.00895595550537 16.04427719116211 13.32688236236572 15.98550987243652 13.57923030853271 15.92929935455322 C 13.47646522521973 15.71267890930176 13.36806297302246 15.49333190917969 13.27691650390625 15.30890560150146 C 12.53316688537598 13.80394554138184 11.60753631591797 11.93096542358398 11.60753631591797 9.689735412597656 C 11.60753631591797 7.694795608520508 11.08611679077148 5.900515556335449 10.13931655883789 4.637415885925293 C 9.324895858764648 3.550905227661133 8.304265975952148 2.999996185302734 7.105806350708008 2.999996185302734 M 7.105806350708008 -3.814697265625e-06 C 11.59415626525879 -3.814697265625e-06 14.60753631591797 4.338245391845703 14.60753631591797 9.689735412597656 C 14.60753631591797 15.04122543334961 23.29487609863281 19.37947463989258 7.105806350708008 19.37947463989258 C -9.083263397216797 19.37947463989258 -0.3959236145019531 15.04122543334961 -0.3959236145019531 9.689735412597656 C -0.3959236145019531 4.338245391845703 2.617456436157227 -3.814697265625e-06 7.105806350708008 -3.814697265625e-06 Z" stroke="none" fill="#fff"/>
                                                    </g>
                                                    <ellipse id="Ellipse_2" fill="white" data-name="Ellipse 2" cx="2.578" cy="2.578" rx="2.578" ry="2.578" transform="translate(10.712 18.807)"/>
                                                    <g transform="matrix(1, 0, 0, 1, 1.73, -2.31)" filter="url(#Ellipse_30)">
                                                        <circle id="Ellipse_3-2" data-name="Ellipse 3" cx="5" cy="5" r="5" transform="translate(18.27 1.84)" fill="#2ed3ae"/>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </a>
                                </li>
                                @endif
                            @endauth
                        </ul>
                    </div>
                </div>
                <div class="rd-navbar-button mr-5 mr-md-0">
                    @auth
                        @if($noteFicationCount>0)
                        <a href="{{ route('website.account.notifications.index') }}" id="notice-icon" class="d-none d-sm-inline-block">
                            <svg class="position-relative" style="bottom: -10px;left: 28px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="30" viewBox="0 0 30 28">
                                <defs>
                                    <filter id="Ellipse_3" x="9.27" y="-6.157" width="28" height="28" filterUnits="userSpaceOnUse">
                                        <feOffset dy="1" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur"/>
                                        <feFlood flood-color="#2ed3ae"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                    <clipPath id="clip-bell">
                                        <rect width="30" height="28"/>
                                    </clipPath>
                                </defs>
                                <g id="bell" clip-path="url(#clip-bell)">
                                    <g id="bell-2" data-name="bell" transform="translate(-1.73 2.305)">
                                        <g id="Path_105" data-name="Path 105" transform="translate(6.184 -0.573)" fill="none">
                                            <path d="M7.106,0c4.488,0,7.5,4.338,7.5,9.69s8.687,9.69-7.5,9.69S-.4,15.041-.4,9.69,2.617,0,7.106,0Z" stroke="none"/>
                                            <path class="cc" d="M 7.105806350708008 2.999996185302734 C 5.907346725463867 2.999996185302734 4.886715888977051 3.550905227661133 4.072296142578125 4.637415885925293 C 3.125495910644531 5.900515556335449 2.604076385498047 7.694795608520508 2.604076385498047 9.689735412597656 C 2.604076385498047 11.93096542358398 1.678446769714355 13.80394554138184 0.9346961975097656 15.30890560150146 C 0.8435497283935547 15.49333190917969 0.7351474761962891 15.71267890930176 0.6323823928833008 15.92929935455322 C 0.884730339050293 15.98550987243652 1.202656745910645 16.04427719116211 1.599706649780273 16.09959602355957 C 2.932736396789551 16.28530502319336 4.785256385803223 16.37947463989258 7.105806350708008 16.37947463989258 C 9.426356315612793 16.37947463989258 11.27887630462646 16.28530502319336 12.61190605163574 16.09959602355957 C 13.00895595550537 16.04427719116211 13.32688236236572 15.98550987243652 13.57923030853271 15.92929935455322 C 13.47646522521973 15.71267890930176 13.36806297302246 15.49333190917969 13.27691650390625 15.30890560150146 C 12.53316688537598 13.80394554138184 11.60753631591797 11.93096542358398 11.60753631591797 9.689735412597656 C 11.60753631591797 7.694795608520508 11.08611679077148 5.900515556335449 10.13931655883789 4.637415885925293 C 9.324895858764648 3.550905227661133 8.304265975952148 2.999996185302734 7.105806350708008 2.999996185302734 M 7.105806350708008 -3.814697265625e-06 C 11.59415626525879 -3.814697265625e-06 14.60753631591797 4.338245391845703 14.60753631591797 9.689735412597656 C 14.60753631591797 15.04122543334961 23.29487609863281 19.37947463989258 7.105806350708008 19.37947463989258 C -9.083263397216797 19.37947463989258 -0.3959236145019531 15.04122543334961 -0.3959236145019531 9.689735412597656 C -0.3959236145019531 4.338245391845703 2.617456436157227 -3.814697265625e-06 7.105806350708008 -3.814697265625e-06 Z" stroke="none" fill="#000"/>
                                        </g>
                                        <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="2.578" cy="2.578" rx="2.578" ry="2.578" transform="translate(10.712 18.807)"/>
                                        <g transform="matrix(1, 0, 0, 1, 1.73, -2.31)" filter="url(#Ellipse_3)">
                                            <circle id="Ellipse_3-2" data-name="Ellipse 3" cx="5" cy="5" r="5" transform="translate(18.27 1.84)" fill="#2ed3ae"/>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </a>
                        @endif
                    @endauth

                    <a href="{{ route('website.search') }}" id="search-icon" class="d-none d-sm-inline-block">
                        <svg class="position-relative" style="bottom: -10px;left: 17px;" xmlns="http://www.w3.org/2000/svg"
                             width="30" height="28" viewBox="0 0 34.785 32.532"><g fill="none" stroke="#000" stroke-width="4"><circle cx="15.5" cy="15.5" r="15.5" stroke="none"/><circle cx="15.5" cy="15.5" r="13.5" fill="none"/></g><path d="M83.3,78.5l7.79,7.191" transform="translate(-58 -55)" fill="none" stroke="#000" stroke-width="5"/></svg>
                    </a>

                    @auth
                        <div class="dropdown d-inline">
                            <span class="py-2 dropdown-toggle text-white pointer small d-inline" id="dropdownMenuButton" data-toggle="dropdown">
                                <img src="/images/front/user.png" class="rounded-circle border ml-1" width="35" height="35">
                                <span class="text-truncate d-inline-block" style="max-width: 57px;margin-bottom: -11px;">{{ auth()->user()->firstname.' '.auth()->user()->lastname }}</span>
                            </span>
                            <div class="dropdown-menu text-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item small" href="{{ route('website.account.dashboard') }}">حساب کاربری من</a>
                                <a class="dropdown-item small" href="{{ route('website.shop.cart.index') }}">سبدخرید</a>
                                <a class="dropdown-item small" href="{{ route('website.logout') }}">خروج</a>
                            </div>
                        </div>
                    @else
                        <a class="button button-black py-2" href="#loginModal" data-toggle="modal">ورود</a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>

</header>

<div class="service-mm mega-menu border bg-light">
    <div class="col-12 row mx-0 d-flex text-secondary flex-column align-content-start py-5 mt-4 table-responsive" >

        @foreach($services as $service)
        <div class="col-6 col-md-3 text-right pr-xl-5">
            <div class="font-weight-bold text-black mt-4">{{ $service->name }}</div>
            @foreach($service->details as $detail)
            <div><a href="{{ route('website.services.show',$detail->slug) }}">{{ $detail->name }}</a></div>
            @endforeach
        </div>
        @endForeach

    </div>
    <div class="col-12 text-center d-block position-absolute d-lg-none" style="bottom: 3px" onclick="show_mega_menu('service-mm')">
        <span class="button button-black py-1 text-gray-light">بستن</span>
    </div>
</div>

<div class="product-mm mega-menu border bg-light">
    <div class="col-12 row mx-0 d-flex text-secondary flex-column align-content-start py-5 mt-4 table-responsive">
        @foreach($productCategories as $parent)
        <div class="col-6 col-md-3 text-right pr-xl-5">
            <div class="font-weight-bold text-black mt-4">{{ $parent->name }}</div>
            @foreach(App\Models\ProductCategory::where('status',App\Enums\Status::Active)->where('parent_id',$parent->id)->orderBy('name','asc')->get() as $child)
            <div><a href="{{ route('website.shop.products.index',['child'=>$child->id]) }}">{{ $child->name }}</a></div>
            @endforeach
        </div>
        @endforeach


    </div>
    <div class="col-12 text-center d-block position-absolute d-lg-none" style="bottom: 3px" onclick="show_mega_menu('product-mm')">
        <span class="button button-black py-1 text-gray-light">بستن</span>
    </div>
</div>

@push('js')
    <script>
        function show_mega_menu(className) {
            $('.mega-menu').css('top','-100vh');
            let menu = $('.'+className);
            if($(menu).css('top') == '0px'){
                //close
                $(menu).css('top','-100vh');
                $('.rd-navbar-nav > li > a').removeAttr('style');
                $('.toggle-original').css('pointer-events', 'auto');
            }
            else{
                $(menu).css('top',0);
                $('.rd-navbar-nav > li > a').css('color','#000');
                $('.toggle-original').click().css('pointer-events', 'none');

            }
        }
    </script>
@endpush
