@include('sweetalert::alert')
 <!-- header -->
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a href="{{ route('website.account.notifications.index',['seen[]'=>App\Enums\seenStatus::unseen]) }}" title="اعلانات" class="nav-link dropdown-toggle  waves-effect waves-light">
                <i class="fe-bell noti-icon"></i>
                @if($noteFicationCount>0)
                <span class="badge badge-danger rounded-circle noti-icon-badge">{{ $noteFicationCount }}</span>
                @endif
            </a>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ url('/').'/images/front/user.png' }}" alt="user-image" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <span class="IRANYekanRegular">
                        {{ Auth::user()->firstname.' '.Auth::user()->lastname}}
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                    <h6 class="text-overflow m-0 IRANYekanRegular text-danger">خوش آمدید</h6>
                </div>

                <!-- item-->
                <a href="{{ route('website.account.dashboard') }}" class="dropdown-item notify-item">
                    <i class="fa fa-user"></i>
                    <span IRANYekanRegular>حساب کاربری من</span>
                </a>

                <a href="{{ route('website.shop.cart.index') }}" class="dropdown-item notify-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span IRANYekanRegular>سبد خرید</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('website.logout') }}" class="dropdown-item notify-item IR">
                    <i class="mdi mdi-logout"></i>
                    <span>خروج</span>
                </a>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ route('website.index') }}" class="logo text-center">
            <span class="logo-lg">
                <img src="{{url('/') }}/images/front/logo.png" alt="درمانگاه لاوین" height="60">
                <!-- <span class="logo-lg-text-light">Xeria</span> -->
            </span>
            <span class="logo-sm">
                <!-- <span class="logo-sm-text-dark">X</span> -->
                <img src="{{url('/') }}/images/front/logo.png" alt="درمانگاه لاوین" height="60">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
            <button class="button-menu-mobile waves-effect waves-light">
                <i class="fe-menu"></i>
            </button>
        </li>

     
    </ul>
</div>
<!-- end header -->