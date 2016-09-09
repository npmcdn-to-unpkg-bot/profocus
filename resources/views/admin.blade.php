<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title></title>


    <link href="{{ URL::asset('admin/css/bootstrap.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/d8f494a08d.js"></script>

    {{--<link href="{{ URL::asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">--}}

    <!-- Toastr style -->
    <link href="{{ URL::asset('admin/css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ URL::asset('admin/js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/style.css') }}" rel="stylesheet">


    <link href="{{ URL::asset('admin/css/plugins/ladda/ladda-themeless.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/js/plugins/summernote/summernote.css') }}" rel="stylesheet">




    {{--<link href="{{ URL::asset('admin/') }}" rel="stylesheet">--}}


</head>

<body>

<div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="" class="" href="/dashboard">
                            <span class="clear">
                                <span class="block m-t-xs"> <strong class="font-bold">Администратор</strong></span>
                            </span>
                        </a>
                    </div>

                </li>



                <li><a href="/dashboard/slider/list"><i class="fa fa-file"></i> <span class="nav-label">Слайды</span>
                    </a></li>
                <li><a href="/dashboard/category/list"><i class="fa fa-file"></i> <span class="nav-label">Категории</span>
                    </a></li>
                <li><a href="/dashboard/photoroom/list"><i class="fa fa-file"></i> <span class="nav-label">Фотосессии</span>
                    </a></li>
                {{--<li>--}}
                    {{--<a href="/dashboard/orders/list"><i class="fa fa-file"></i> <span class="nav-label">Заказы фотосессии</span>--}}
                    {{--</a>--}}
                {{--</li>--}}

                <li>
                    <a href="/dashboard/articles/list"><i class="fa fa-file"></i> <span class="nav-label">События</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/study/list"><i class="fa fa-file"></i> <span class="nav-label">Курсы</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/study/orders/list"><i class="fa fa-file"></i> <span class="nav-label">Заказы курсы</span>
                    </a>
                </li>







                <li>
                    <a href="/dashboard/location/list"><i class="fa fa-file"></i> <span class="nav-label">Локации</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/equipment/list"><i class="fa fa-file"></i> <span class="nav-label">Оборудование</span>
                    </a>
                </li>






                <li>
                    <a href="/dashboard/models/list"><i class="fa fa-file"></i> <span class="nav-label">Модели</span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/discount/list"><i class="fa fa-file"></i> <span class="nav-label">Скидки</span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/partners/list"><i class="fa fa-file"></i> <span class="nav-label">Партнеры</span>
                    </a>
                </li>


                <li>
                    <a href="/dashboard/files/list"><i class="fa fa-image"></i> <span class="nav-label">Галереи</span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/stuff"><i class="fa fa-file-o"></i> <span class="nav-label">Материалы</span>
                    </a>
                </li>

                <li>
                    <a href="/dashboard/networks/list"><i class="fa fa-globe"></i> <span class="nav-label">Социальные сети</span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/setting"><i class="fa fa-cog"></i> <span class="nav-label">Настройка</span>
                    </a>
                </li>

            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                 <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
           
            </div>
                <ul class="nav navbar-top-links navbar-right">
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-bell"></i>  <span class="label label-primary">8</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-alerts">--}}
                            {{--<li>--}}
                                {{--<a href="mailbox.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-envelope fa-fw"></i> You have 16 messages--}}
                                        {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<a href="profile.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-twitter fa-fw"></i> 3 New Followers--}}
                                        {{--<span class="pull-right text-muted small">12 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<a href="grid_options.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-upload fa-fw"></i> Server Rebooted--}}
                                        {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a href="notifications.html">--}}
                                        {{--<strong>See All Alerts</strong>--}}
                                        {{--<i class="fa fa-angle-right"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown">--}}
                        {{--<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-calendar"  aria-hidden="true" ></i>  <span class="label label-primary">8</span>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-alerts">--}}
                            {{--<li>--}}
                                {{--<a href="mailbox.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-envelope fa-fw"></i> You have 16 messages--}}
                                        {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<a href="profile.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-twitter fa-fw"></i> 3 New Followers--}}
                                        {{--<span class="pull-right text-muted small">12 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<a href="grid_options.html">--}}
                                    {{--<div>--}}
                                        {{--<i class="fa fa-upload fa-fw"></i> Server Rebooted--}}
                                        {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--<li class="divider"></li>--}}
                            {{--<li>--}}
                                {{--<div class="text-center link-block">--}}
                                    {{--<a href="notifications.html">--}}
                                        {{--<strong>See All Alerts</strong>--}}
                                        {{--<i class="fa fa-angle-right"></i>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}


                    <li>
                        <a href="{{ url("logout") }}">
                            <i class="fa fa-sign-out"></i> Выход
                        </a>
                    </li>                    <li>
                        <a href="/" target="_blank">
                            <i class="fa fa-globe"></i>
                        </a>
                    </li>
                </ul>

            </nav>
        </div>



        @yield('content')




    </div>
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


<!-- Peity -->
<script src="{{ URL::asset('admin/js/plugins/peity/jquery.peity.min.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>


<!-- Custom and plugin javascript -->
<script src="{{ URL::asset('admin/js/inspinia.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/pace/pace.min.js') }}"></script>

<!-- jQuery UI -->
<script src="{{ URL::asset('admin/js/plugins/jquery-ui/jquery-ui.js') }}"></script>

<!-- GITTER -->
<script src="{{ URL::asset('admin/js/plugins/gritter/jquery.gritter.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ URL::asset('admin/js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Sparkline demo data  -->

<!-- ChartJS-->
<script src="{{ URL::asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

<!-- Toastr -->
<script src="{{ URL::asset('admin/js/plugins/toastr/toastr.min.js') }}"></script>

<script src="{{ URL::asset('admin/js/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/switchery/switchery.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/switchery/switchery.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>
<script src="{{ URL::asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>



<script src="{{ URL::asset('admin/js/inputmask.js') }}"></script>
<script src="{{ URL::asset('admin/js/inputmask.date.extensions.js') }}"></script>
<script src="{{ URL::asset('admin/js/jquery.inputmask.js') }}"></script>




<script src="https://unpkg.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>

<script src="{{ URL::asset('admin/js/plugins/switchery/switchery.js') }}"></script>




<script src="{{ URL::asset('admin/js/plugins/wysiwyg/summernote.js') }}"></script>


<script src="{{ URL::asset('../js/jquery.fancybox.pack.js') }}"></script>


<script src="{{ URL::asset('admin/js/jquery.infinitescroll.js') }}"></script>
<script src="{{ URL::asset('admin/js/masonry.min.js') }}"></script>
@yield('footer')
<script>




    $(document).ready(function(){




        $('.page-setting').on("click", function(){
            var setting = $(this);
            var id = setting.data('page');

            $.ajax({
                type: 'POST',
                url: "{{ url( "dashboard/pages")  }}" + "/" + id,
                success: function(data){
                    // alert(data['title']);
                    $('.page-title').val(data['title']);
                    $('.summernote').summernote('code', data['body']);

                },
                error: function (data) {
                    swal({
                        type: "error",
                        title: "Oops! Ошибка",
                        text: data.responseJSON.file + " Если ошибка не исчезает - пиши Андрею, он ждет :)",
                        timer: 5000,
                        closeOnConfirm: true,
                    });
                    //document.write();
                    console.log(data.responseJSON.file);
                    //alert(data.responseText);

                },
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                contentType: false,
                processData: false,
            });


            $("#form").submit(function(){
                event.preventDefault()

                var data = new FormData();
                $.ajax({
                    type: 'POST',

                    url: "{{ url( "dashboard/pages/edit")  }}" + "/" + id,
                    data: new FormData( this ),
                    success: function(data){
                        swal({
                            title: "Готово!",
                            text: "Все сделали, все загрузили и создали! Добавим еще, что - то?",
                            type: "success",
                            showCancelButton: false,
                            closeOnConfirm: false,
                            timer: 1500,
                            animation: "slide-from-top",
                        });
                        $('.bs-example-modal-lg').modal('hide')
                        //location.reload();
                        //window.location = "/dashboard/article/list";

                    },
                    error: function (data) {
                        swal({
                            type: "error",
                            title: "Oops! Ошибка",
                            text: data.responseJSON.file + " Если ошибка не исчезает - пиши Андрею, он ждет :)",
                            timer: 5000,
                            closeOnConfirm: true,
                        });
                        //document.write();
                        console.log(data.responseJSON.file);
                        //alert(data.responseText);

                    },
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    contentType: false,
                    processData: false,
                });

            });

        })

    })
</script>
</body>
</html>
