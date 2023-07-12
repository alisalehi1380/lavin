
<!--  menu sidebar -->
<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">


                @if(Auth::guard('admin')->user()->can('dashboard'))  
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="fa fa-home"></i>
                        <span class="IRANYekanRegular">داشبورد</span>
                    </a>
                </li>
                @endif 

                @if(Auth::guard('admin')->user()->can('article.index') || Auth::guard('admin')->user()->can('article.categorys.index'))  
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-newspaper"></i>
                        <span class="IRANYekanRegular">مقالات</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        @if(Auth::guard('admin')->user()->can('article.index')) 
                        <li>
                            <a href="{{ route('admin.article.index') }}" class="waves-effect">
                                <i class="fas fa-newspaper"></i>
                                <span class="IRANYekanRegular">مقالات</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('article.categorys.index')) 
                        <li>
                            <a href="{{ route('admin.article.categorys.index') }}" class="waves-effect">
                                <i class="fas fa-layer-group"></i>
                                <span class="IRANYekanRegular">دسته بندی‌ها</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif 

                
                @if(Auth::guard('admin')->user()->can('services.index') || Auth::guard('admin')->user()->can('services.categories.index')) 
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fab fa-servicestack"></i>
                        <span class="IRANYekanRegular">خدمات</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        
                        @if(Auth::guard('admin')->user()->can('services.index')) 
                        <li>
                            <a href="{{ route('admin.services.index') }}" class="waves-effect">
                                <i class="fab fa-servicestack"></i>
                                <span class="IRANYekanRegular">سرگروه خدمات</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('services.categories.index')) 
                        <li>
                            <a href="{{ route('admin.services.categories.index') }}" class="waves-effect">
                                <i class="fas fa-layer-group"></i>
                                <span class="IRANYekanRegular">دسته بندی‌ها</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('services.details.index')) 
                        <li>
                            <a href="{{ route('admin.details.index') }}" class="waves-effect">
                                <i class="fa fa-info"></i>
                                <span class="IRANYekanRegular">خدمات</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif 

                
                @if(Auth::guard('admin')->user()->can('reserves.index')) 
                <li>
                    <a href="{{ route('admin.reserves.index') }}" class="waves-effect">
                        <i class="fab fa-first-order-alt"></i>
                        <span class="IRANYekanRegular">رزروها</span>
                    </a>
                </li>
                @endif 

                @if(Auth::guard('admin')->user()->can('doctors.index')) 
                <li>
                    <a href="{{ route('admin.doctors.index') }}" class="waves-effect">
                        <i class="fas fa-user-md"></i>
                        <span class="IRANYekanRegular">پزشکان</span>
                    </a>
                </li>
                @endif 

                @if(Auth::guard('admin')->user()->can('tickets.index') || Auth::guard('admin')->user()->can('departments.index')) 
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="IRANYekanRegular">پشتیبانی</span>
                        <span class="menu-arrow"></span>
                    </a>

                    @if(Auth::guard('admin')->user()->can('tickets.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="IRANYekanRegular">
                            <a href="{{ route('admin.tickets.index') }}">تیکت ها</a>
                        </li>
                    </ul>
                    @endif

                    @if(Auth::guard('admin')->user()->can('departments.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="IRANYekanRegular">
                            <a href="{{ route('admin.departments.index') }}">واحدها</a>
                        </li>
                    </ul>
                    @endif
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('notifications.index')) 
                <li>
                    <a href="{{ route('admin.notifications.index') }}" class="waves-effect">
                        <i class="fas fa-bell"></i>
                        <span class="IRANYekanRegular">اعلانات</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('faq.index')) 
                <li>
                    <a href="{{ route('admin.faq.index') }}" class="waves-effect">
                        <i class="fas fa-question"></i>
                        <span class="IRANYekanRegular">پرسش و پاسخ</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('rewiewGroups.index') || Auth::guard('admin')->user()->can('reviews.index')) 
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-poll"></i>
                        <span class="IRANYekanRegular">نظرسنجی</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        
                       @if(Auth::guard('admin')->user()->can('rewiewGroups.index'))
                        <li>
                            <a href="{{ route('admin.rewiewGroups.index') }}" class="waves-effect">
                                <i class="fas fa-layer-group"></i>
                                <span class="IRANYekanRegular">گروه بازخوردها</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('reviews.index'))
                        <li>
                            <a href="{{ route('admin.reviews.index') }}" class="waves-effect">
                                <i class="fa fa-comments"></i>
                                <span class="IRANYekanRegular">بازخوردها</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('gallery.index'))
                <li>
                    <a href="{{ route('admin.gallery.index') }}" class="waves-effect">
                        <i class="fas fa-images"></i>
                        <span class="IRANYekanRegular">گالری تصاویر</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('shop.products.index') || Auth::guard('admin')->user()->can('shop.products.categories.index') ||
                Auth::guard('admin')->user()->can('shop.products.sells.index'))
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="IRANYekanRegular">فروشگاه</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">

                        @if(Auth::guard('admin')->user()->can('shop.products.index'))
                        <li>
                            <a href="{{ route('admin.shop.products.index') }}" class="waves-effect">
                                <i class="fab fa-product-hunt"></i>
                                <span class="IRANYekanRegular">محصولات</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('shop.products.categories.index'))
                        <li>
                            <a href="{{ route('admin.shop.products.categories.index') }}" class="waves-effect">
                                <i class="fas fa-layer-group"></i>
                                <span class="IRANYekanRegular">دسته بندی‌ها</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::guard('admin')->user()->can('shop.products.sells.index'))
                        <li>
                            <a href="{{ route('admin.shop.sells.index') }}" class="waves-effect">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="IRANYekanRegular">فروش‌ها</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('discounts.index'))
                <li>
                    <a href="{{ route('admin.discounts.index') }}" class="waves-effect">
                        <i class="fas fa-percent"></i>
                        <span class="IRANYekanRegular">کد‌ تخفیف</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('luck.index'))
                <li>
                    <a href="{{ route('admin.luck.index') }}" class="waves-effect">
                        <i class="fas fa-hockey-puck"></i>
                        <span class="IRANYekanRegular">گردونه شانس</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('portfolios.index'))
                <li>
                    <a href="{{ route('admin.portfolios.index') }}" class="waves-effect">
                        <i class="fas fa-suitcase"></i>
                        <span class="IRANYekanRegular">نمونه کارها</span>
                    </a>
                </li>
                @endif


                @if(Auth::guard('admin')->user()->can('comments.index'))
                <li>
                    <a href="{{ route('admin.comments.index') }}" class="waves-effect">
                        <i class="fa fa-comments"></i>
                         <?php
                            $unapproved = App\Models\Comment::where('approved',App\Enums\CommentStatus::unapproved)->count();
                         ?>
                        @if($unapproved>0)
                        <span class="badge badge-info float-right">{{ $unapproved }}</span>
                        @endif
                        <span class="IRANYekanRegular">نظرات</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('provinces.index'))
                <li>
                    <a href="{{ route('admin.provinces.index') }}" class="waves-effect">
                        <i class="fas fa-map-marker"></i>
                        <span class="IRANYekanRegular">استان‌ها</span>
                    </a>
                </li>
                @endif


                @if(Auth::guard('admin')->user()->can('jobs.index'))
                <li>
                    <a href="{{ route('admin.jobs.index') }}" class="waves-effect">
                        <i class="fa fa-graduation-cap"></i>
                        <span class="IRANYekanRegular">مشاغل</span>
                    </a>
                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('socialmedia.index') || Auth::guard('admin')->user()->can('phones.index')
                    || Auth::guard('admin')->user()->can('messages.index') || Auth::guard('admin')->user()->can('departments.index'))
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-address-book"></i>
                        <span class="IRANYekanRegular">راه های ارتباطی</span>
                        <span class="menu-arrow"></span>
                    </a>

                    @if(Auth::guard('admin')->user()->can('socialmedia.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="IRANYekanRegular">
                            <a href="{{ route('admin.socialmedia.index') }}">
                                <i class="fab fa-instagram"></i>
                                شبکه های اجتماعی
                            </a>
                        </li>
                    </ul>
                    @endif

                    @if(Auth::guard('admin')->user()->can('phones.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="IRANYekanRegular">
                            <a href="{{ route('admin.phones.index') }}">
                            <i class="fas fa-phone"></i>
                             تلفن های تماس
                            </a>
                        </li>
                    </ul>
                    @endif

                    @if(Auth::guard('admin')->user()->can('messages.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li class="IRANYekanRegular">
                            <a href="{{ route('admin.messages.index') }}">
                                <i class="fas fa-envelope-square"></i>
                                 پیام ها
                            </a>
                        </li>
                    </ul>
                    @endif

                </li>
                @endif

                @if(Auth::guard('admin')->user()->can('admins.index') || Auth::guard('admin')->user()->can('users.index')
                    || Auth::guard('admin')->user()->can('levels.index') || Auth::guard('admin')->user()->can('roles.index')
                    || Auth::guard('admin')->user()->can('numbers.index'))
                 <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fa fa-users"></i>
                        <span class="IRANYekanRegular">کاربران</span>
                        <span class="menu-arrow"></span>
                    </a>

                    @if(Auth::guard('admin')->user()->can('admins.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.admins.index') }}" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="IRANYekanRegular">ادمین ها</span>
                            </a>
                        </li>
                    </ul>
                    @endif 



                    @if(Auth::guard('admin')->user()->can('users.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="waves-effect">
                                <i class="fa fa-user"></i>
                                <span class="IRANYekanRegular">کاربران عادی</span>
                            </a>
                        </li>
                    </ul>
                    @endif 


                    @if(Auth::guard('admin')->user()->can('numbers.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.numbers.index') }}" class="waves-effect">
                                <i class="fa fa-phone"></i>
                                <span class="IRANYekanRegular">نمابر</span>
                            </a>
                        </li>
                    </ul>
                    @endif 

                    
                    @if(Auth::guard('admin')->user()->can('levels.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.levels.index') }}" class="waves-effect">
                                <i class="fas fa-layer-group"></i>
                                <span class="IRANYekanRegular">سطوح</span>
                            </a>
                        </li>
                    </ul>
                    @endif 

                    @if(Auth::guard('admin')->user()->can('roles.index')) 
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.roles.index') }}" class="waves-effect">
                                <i class="fas fa-universal-access"></i>
                                <span class="IRANYekanRegular">نقش‌ها</span>
                            </a>
                        </li>
                    </ul>
                    @endif 
                </li>
                @endif
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- end menu sidbar -->
