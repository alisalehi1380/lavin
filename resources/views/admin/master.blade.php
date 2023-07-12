<!DOCTYPE html>
<html lang="en">
@include('admin.include.head')
<body>
<div id="wrapper">
@include('admin.include.header')
@include('admin.include.menu-sidbar')
@yield('content')
</div>
@include('admin.include.setting-sidbar')
<div class="rightbar-overlay"></div>
@include('admin.include.footer')
</body>
</html>
