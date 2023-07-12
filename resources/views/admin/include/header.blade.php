@include('sweetalert::alert')
 <!-- header -->
<div class="navbar-custom">
    
    <ul class="list-unstyled topnav-menu float-right mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ url('/').'/images/front/user.png' }}" alt="user-image" class="rounded-circle">
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <span class="IRANYekanRegular">
                        {{ Auth::guard('admin')->user()->fullname }}
                        <i class="mdi mdi-chevron-down"></i>
                    </span>
                    <h6 class="text-overflow m-0 IRANYekanRegular text-danger">خوش آمدید</h6>
                </div>
  
                <div class="dropdown-divider"></div>

                <!-- item-->
                <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item IR">
                    <i class="mdi mdi-logout"></i>
                    <span>خروج</span>
                </a>

            </div>
        </li>

    </ul>
   

    <!-- LOGO -->
    <div class="logo-box">
        <a href="{{ route('admin.dashboard') }}" class="logo text-center">
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