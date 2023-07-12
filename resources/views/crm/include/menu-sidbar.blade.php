
<!--  menu sidebar -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                
                <li>
                    <a href="{{ route('website.index') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span class="IRANYekanRegular">صفحه اصلی</span>
                    </a>
                </li>

              
                <li>
                    <a href="{{ route('website.account.dashboard') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span class="IRANYekanRegular">داشبورد</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('website.account.notifications.index') }}" class="waves-effect">
                        <i class="fe-bell noti-icon"></i>
                        <span class="IRANYekanRegular">اعلانات</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('website.account.discount.index') }}" class="waves-effect">
                        <i class="fas fa-percent"></i>
                        @if(Auth::user()->discountsNumber())
                        <span class="badge badge-info float-right" title="اسستفاده نشده">{{ Auth::user()->discountsNumber() }}</span>
                        @endif
                        <span class="IRANYekanRegular">کد تخفیف</span>
                    </a>
                </li>


                
                <li>
                    <a href="{{ route('website.account.tickets.index') }}" class="waves-effect">
                        <i class="fas fa-ticket-alt"></i>
                        <span class="IRANYekanRegular">تیکت ها</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('website.account.reserves.index') }}" class="waves-effect">
                        <i class="fab fa-first-order-alt"></i>
                        <span class="IRANYekanRegular">رزروها</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('website.account.buy') }}" class="waves-effect">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="IRANYekanRegular">خریدها</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('website.account.profile.index') }}" class="waves-effect">
                        <i class="fa fa-user"></i>
                        <span class="IRANYekanRegular">پروفایل</span>
                    </a>
                </li>
   
   

          





            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- end menu sidbar -->
