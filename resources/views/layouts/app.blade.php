
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title></title>


    <link href="{{ URL::asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ URL::asset('admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ URL::asset('admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/style.css') }}" rel="stylesheet">


    <link href="{{ URL::asset('admin/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/css/jquery.datetimepicker.css') }}" rel="stylesheet">


    {{--<link href="{{ URL::asset('admin/') }}" rel="stylesheet">--}}


</head>

<body class="gray-bg">
<div id="wrapper">
           @yield('content')


</div>










<!-- Mainly scripts -->

<script src="{{ URL::asset('admin/js/jquery-2.1.1.js') }}"></script>
<script src="{{ URL::asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ URL::asset('admin/js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/tinymce/tinymce.min.js') }}"></script>
<script src="{{ URL::asset('admin/jquery.datetimepicker.full.js') }}"></script>

<!-- Peity -->
<script src="{{ URL::asset('admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/demo/peity-demo.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>


<!-- Custom and plugin javascript -->
<script src="{{ URL::asset('admin/js/inspinia.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ URL::asset('admin/js/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- GITTER -->
<script src="{{ URL::asset('admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ URL::asset('admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->
<script src="{{ URL::asset('admin/js/demo/sparkline-demo.js') }}"></script>

<!-- ChartJS-->
<script src="{{ URL::asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ URL::asset('admin/js/plugins/toastr/toastr.min.js') }}"></script>
@yield('footer')

</body>
</html>
