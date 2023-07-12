<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lavin | لاوین</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link href="/fontawesome5.15.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/') }}/panel/assets/js/sweetalert.min.js" />
    @stack('css')
</head>
<body>
    <div id="app">
        @yield('content')
        @include('layouts.footer')
        @include('includes.elements.modal-login')
    </div>

    @include('sweetalert::alert')
    <script src="/js/app.js"></script>
    <script src="/js/core.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>

        $.map($('[data-price]'), item =>{
            per = new Number(item.innerText).toLocaleString('fa-ir');
            item.innerText = per;
        });
        var scrolled = false;
        $(window).scroll(function() {
            //if I scroll more than 1000px...
            if($(window).scrollTop() > 10 && scrolled == false){
                $('#lavin-logo').css('height',50)
                scrolled = true;
            } else if($(window).scrollTop() == 0) {
                scrolled = false;
                $('#lavin-logo').css('height',110)
            }
        });
        $(document).ready(function(){
            if(window.matchMedia("(max-width: 575px)").matches){
                $('.rd-navbar-nav-wrap').css('display', 'block')
            }
        })
        AOS.init({once: true});
    </script>
    @stack('js')
</body>
</html>
