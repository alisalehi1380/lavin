<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 IR">
                2021 - 2022 &copy;توسعه داده شده توسط <a  target="_blanck" href="http://tkp.ir/">تک پرداز</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

 
 
    @include('sweetalert::alert')

    <script src="{{ url('/') }}/panel/assets/js/vendor.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/jquery-vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/peity/jquery.peity.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/js/pages/dashboard-2.init.js"></script>
    <script src="{{ url('/') }}/panel/assets/js/app.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/switchery/switchery.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/multiselect/jquery.multi-select.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/jquery-quicksearch/jquery.quicksearch.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/libs/jquery-mask-plugin/jquery.mask.min.js"></script>
    <script src="{{ url('/') }}/panel/assets/js/pages/form-advanced.init.js"></script>
    <script src="{{ url('/') }}/panel/assets/js/jquery.md.bootstrap.datetimepicker.js" type="text/javascript"></script>
    <script src="{{ url('/') }}/panel/assets/datatables/jquery.dataTables.min.js" type="text/javascript"></script> --> -->
  
  <!-- preogressbar -->
  @if(Route::currentRouteName()=='admin.services.details.videos.create'
 || Route::currentRouteName()=='admin.portfolios.create'
 || Route::currentRouteName()=='admin.portfolios.edit'
 || Route::currentRouteName()=='admin.doctors.video')
 <script src="{{ url('/') }}/panel/assets/js/jquery.min.js"></script>
 <script src="{{ url('/') }}/panel/assets/js/jquery.form.js"></script>
 @endif  

 @if(Route::currentRouteName()=='admin.reserves.create')
 <script src="{{ url('/') }}/panel/assets/js/ajax-jquery.min.js"></script>
 <script src="{{ url('/') }}/panel/assets/js/ajax-select2.min.js"></script>
 @endif

 @yield('script')





<!-- end footer -->
