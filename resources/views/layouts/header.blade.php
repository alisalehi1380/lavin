<div class="col-12 text-center text-white bg-black small" style="z-index: 3">
    <div><svg style="padding-top: 8px" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><g fill="none" stroke="#ccad33" stroke-width="3"><circle cx="10" cy="10" r="10" stroke="none"/><circle cx="10" cy="10" r="8.5" fill="none"/></g><path d="M1306.01,13.366l4.637,3,4.637-5.183" transform="translate(-1300.647 -5.775)" fill="none" stroke="#ccad33" stroke-width="1"/></svg>
        درمانگاه به صورت شبانه روزی فعالیت می‌کند. جهت رزرو با شماره <a href="tel:0133636">0133636</a> تماس بگیرید</div>
</div>

<div class="text-center page">

    @include('includes.elements.menu')

    @isset($title)
    <div class="h-title d-flex justify-content-center align-items-center" style="min-height: 220px">
        <div class="col-7 text-center">
            <h1 class="h3 dima text-pink mt-4">{{ $title ?? '' }}</h1>
        </div>
    </div>
    @endisset
</div>


@push('css')
    <style>
        .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a,
        .rd-navbar-static:not(.rd-navbar--is-stuck) #dropdownMenuButton span{
            color: #616161;
        }
        .rd-navbar-static:not(.rd-navbar--is-stuck) .rd-navbar-nav > li > a:hover{
            color: #2ed3ae;
        }
        @media (max-width: 700px) {
            .h-title{
                min-height: auto !important;
            }
            .h3{
                font-size: 20px;
            }
        }
        @isset($background)
        .page{
            background-image: url({{ $background }});
            background-position: top;
            background-size: 100%;
        }
        @endisset
    </style>
@endpush
