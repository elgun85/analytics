
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('NiceAdmin/')}}/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/chart.js/chart.umd.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/echarts/echarts.min.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/quill/quill.min.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="{{asset('NiceAdmin/')}}/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="{{asset('NiceAdmin/')}}/assets/js/main.js"></script>


@yield('select_js')
@yield('script')
@yield('data_table_js')
@yield('select_all')

</body>

</html>
