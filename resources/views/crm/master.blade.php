<!DOCTYPE html>
<html lang="en">
@include('crm.include.head')
<body>
<div id="wrapper">
@include('crm.include.header')
@include('crm.include.menu-sidbar')       
@yield('content')
</div>
@include('crm.include.setting-sidbar')
<div class="rightbar-overlay"></div>
@include('crm.include.footer')
</body>
</html>
