<?
$rand = rand(0,1);
        switch($rand)
        {
            case 0: $bg = 'light'; break;
            case 1: $bg = 'dark'; break;
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/application/require/images/favicon.png">
<title>@yield('title')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <!-- Bootstrap core CSS -->

    <link href="{{ URL::asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

		<link rel="stylesheet" href="{{ URL::asset('css/karla-font.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/montserrat-font.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/plugins.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('style.css') }}" />
{{--		<link rel="stylesheet" href="{{ URL::asset('css/blue.css') }}" />--}}
		<link rel="stylesheet" href="{{ URL::asset('css/icons.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('css/jquery.datetimepicker.css') }}" >

    <link href="{{ URL::asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- Fontello -->
        <link rel="stylesheet" href="{{ URL::asset('fonts/social/css/fontello.css') }}" type="text/css" media="screen" />
        <link rel="stylesheet" href="{{ URL::asset('fonts/social/css/fontello-codes.css') }}" type="text/css" media="screen" />
        <link rel="stylesheet" href="{{ URL::asset('fonts/social/css/fontello-embedded.css') }}" type="text/css" media="screen" />
        <link rel="stylesheet" href="{{ URL::asset('fonts/social/css/fontello-ie7.css') }}" type="text/css" media="screen" />
        <link rel="stylesheet" href="{{ URL::asset('fonts/social/css/fontello-ie7-codes.css') }}" type="text/css" media="screen" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800&subset=latin,latin-ext,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body><div id="preloader"><div class="textload">Загрузка</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">

  <div class="navbar <? if(request()->route()->getName() != 'home') echo 'solid ' . $bg ?> ">
    <div class="navbar-header">
      <div class="basic-wrapper">
        <div class="navbar-brand">
            <a href="index.html">
                <img src="#" srcset="{{ URL::asset('images/logo.png') }}, /images/logo.png" class="logo-light" alt="" />
                <img src="#" srcset="{{ URL::asset('images/logo-dark.png') }}, /images/logo-dark.png" class="logo-dark" alt="" />
            </a>
        </div>
        <a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
      </div>
      <!-- /.basic-wrapper -->
    </div>
    <!-- /.navbar-header -->
    <nav class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
          <?php foreach( $navigation as $way ):
              if( $way['page'] == 'home' )
              {
                  $way['page'] = '/';
              }




                  if( $way['page'] == "rent" ){ ?>
                    <li class=" dropdown"><a href="{{ url($way['page']) }}" class="dropdown-toggle js-activated">{{ $way['title'] }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url($way['page']) }}#rent">Аренда студии</a></li>
                            <li><a href="{{ url($way['page']) }}#rules">Правила аренды</a></li>
                            <li><a href="{{ url($way['page']) }}#locations">Локации</a></li>
                            <li><a href="{{ url($way['page']) }}#booking">Онлайн бронирование</a></li>
                            <li><a href="{{ url($way['page']) }}#equipment">Оборудование</a></li>
                        </ul>
                    </li>
          <? continue;}

                  else{
               ?>
              <li><a href="{{ url($way['page']) }}">{{ $way['title'] }}</a></li>
                  <?php }





          endforeach ?>
        <!-- <li><a href="#" style="color: #70aed2 !important;">бронировать онлайн</a></li> -->

      </ul>
      <!-- /.navbar-nav -->
    </nav>
    <!-- /.navbar-collapse -->
    <div class="social-wrapper">
      <ul class="social naked">
          @foreach( $networks as $network )
            <li><a href="{{ $network['href'] }}" target="_blank"><i class="icon-{{ $network['class'] }}"></i></a></li>
          @endforeach
      </ul>
      <!-- /.social -->
    </div>
    <!-- /.social-wrapper -->
  </div>
  <!-- /.navbar -->
                @yield('content')


    <footer class="footer inverse-wrapper">
    <div class="container inner">
      <div class="row">


        <div class="col-sm-8">

        </div>
        <!-- /column -->

        <div class="col-sm-4">
          <div class="widget">
            <div class="contact-info">
              <i class="fa fa-map-marker"></i> {{ $settings[0]['city'] }}<br />
              <i class="fa fa-phone"> {{ $settings[0]['phone'] }}</i><br />
              <i class="fa fa-envelope"></i>
                <a href="" onclick="return false;"> {{ $settings[0]['email'] }}</a> </div>
          </div>
          <!-- /.widget -->

        </div>
        <!-- /column -->

      </div>
      <!-- /.row -->
    </div>
    <!-- .container -->
    <!-- .sub-footer -->
  </footer>
  <!-- /footer -->
    <div class="slide-portfolio-overlay"></div><!-- overlay that appears when slide portfolio content is open -->
</main>

<!--/.body-wrapper -->

    @yield('model')
    @yield('discount')
    @yield('home')

    <a href="#0" class="slide-portfolio-item-content-close"><i class="fa fa-close"></i></a> <!-- close slide portfolio content -->

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('js/plugins.js') }}"></script>
	<script src="{{ URL::asset('js/classie.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.datetimepicker.full.js') }}"></script>
	<script src="{{ URL::asset('js/scripts.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.fancybox.pack.js') }}"></script>

	<script src="{{ URL::asset('js/masonry.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.infinitescroll.js') }}"></script>
	<script src="{{ URL::asset('js/jquery-ias.min.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.shorten.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.nicescroll.min.js') }}"></script>


    <script>
        $(document).ready( function(){

            $(".morer").shorten({
                moreText: 'Продолжить',
                lessText: 'Скрыть',
                showChars: 300
            });

        } );

        $('#order').on('submit',function(event){
            var progressBar = $('#pb');
            event.preventDefault();
            $.ajax({
                data: new FormData(this),
                type: "POST",
                url: "{{ url('order/new') }}",
                cache: false,
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                success: function(url) {
                    //toastr.success( "Добавлено!" );
                    var notificationContainer = $('.notification');
                    notificationContainer.css( 'background','#27ae60' );
                    notificationContainer.text( "Добавлено!" );
                    setTimeout(function () {
                        $('.bs-example-modal-lg').modal('hide');
                        $('#order').trigger('reset');
                        notificationContainer.text("");
                        notificationContainer.css("background","#fff");
                    },1000);


                },
                error: function (data) {

                    var errors = data.responseJSON;
                    var errorsHtml= '';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    //toastr.error( errorsHtml , "Ошибка " + data.status );
                    $('.notification').css( 'background','#e74c3c' );
                    $('.notification').html( errorsHtml );


                },
                xhr: function(){
                    var xhr = $.ajaxSettings.xhr(); // получаем объект XMLHttpRequest
                    xhr.upload.addEventListener('progress', function(evt){ // добавляем обработчик события progress (onprogress)
                        if(evt.lengthComputable) { // если известно количество байт
                            // высчитываем процент загруженного
                            var percentComplete = Math.ceil(evt.loaded / evt.total * 100);
                            // устанавливаем значение в атрибут value тега <progress>
                            // и это же значение альтернативным текстом для браузеров, не поддерживающих <progress>
                            progressBar.css("width", percentComplete+"%").text('Загружено ' + percentComplete + '%');
                            //progressBar.val(percentComplete).text('Загружено ' + percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },
                contentType: false,
                processData: false
            });
        });

    </script>

    @yield('footer')


    </body>
</html>
