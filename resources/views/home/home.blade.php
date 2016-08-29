@extends('template')

@section('title')
    {{ $page[0]['title'] }}
@stop

@section('content')

  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>

          @foreach( $slider as $slide )

              @if( $slide['type'] == 'img' )
                  <li data-transition="fade"> <img src="{{ url($slide['path']) }}"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
                      <div class="tp-caption large text-center sfb" data-x="center" data-y="293" data-speed="900" data-start="800" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;">{!! $slide['title'] !!}</div>
                      <div class="tp-caption medium text-center sfb" data-x="center" data-y="387" data-speed="900" data-start="1500" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;">{!! $slide['body'] !!}</div>
                  </li>
              @else
                  <li data-transition="fade"> <img src="<?= $slide['cover'] ?>" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat" />
                      <div class="tp-caption large text-center sfb" data-x="center" data-y="293" data-speed="900" data-start="800" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;">{!! $slide['title'] !!}</div>
                      <div class="tp-caption medium text-center sfb" data-x="center" data-y="387" data-speed="900" data-start="1500" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;">{!! $slide['body'] !!}</div>
                      <div class="tp-caption tp-fade fadeout fullscreenvideo"
                           data-x="0"
                           data-y="0"
                           data-speed="1000"
                           data-start="1100"
                           data-easing="Power4.easeOut"
                           data-elementdelay="0.01"
                           data-endelementdelay="0.1"
                           data-endspeed="1500"
                           data-endeasing="Power4.easeIn"
                           data-autoplay="true"
                           data-autoplayonlyfirsttime="false"
                           data-nextslideatend="true"
                           data-dottedoverlay="twoxtwo"
                           data-volume="mute" data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on" style="z-index: 1;">
                          <video class=""  preload="none" width="100%" height="100%"
                                 poster='{{ url("images/cover.png") }}'>
                              <source src="<?= $slide['mp4'] ;?>" type='video/mp4' />
                              <source src="<?= $slide['webm']?>" type='video/webm' />
                          </video>
                      </div>
                  </li>
              @endif
              @endforeach

      </ul>
      <div class="tp-bannertimer tp-bottom"></div>
    </div>
    <!-- /.tp-fullscreen-container -->
  </div>
  <!-- /.revolution -->
  <table border="1">


</table>
  <div class="light-wrapper">
    <div class="container inner">
        
        <div class="row">

            <div class="col-lg-4 col-md-6 hidden-sm hidden-xs">

                <img src="{{ url($page[0]['thumbnail']) }}" style="display:block; margin:auto;" width1="100%" alt="">
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                {!! $page[0]['body'] !!}
            </div>
            
        </div>
        <div class="divide60"></div>
        <div id="js-grid-mosaic-more" class="cbp-l-loadMore-text">
            <a href="#!" data-toggle="modal" data-target=".bs-example-modal-lg" class="cbp-l-loadMorelink btn"
               rel="nofollow">
                <span class="cbp-l-loadMore-defaultText">заказать фотосессию сейчас</span>
            </a>
        </div>

    </div>
    <!-- /.container -->
  </div>
  <!-- /.light-wrapper -->



  <div class="dark-wrapper">
      <div class="container inner">
          <h3 class="section-title text-center">Photo Room by PRO-FOCUS! Cпособен на все!</h3>
          <div class="divide60"></div>
          <div class="carousel-wrapper">
              <div class="carousel carousel-boxed blog categoryList">

                  @foreach( $category as $data )
                  <div class="item post">
                      <figure class="main"><img src="{{ url($data['thumbnail']) }}" alt="" /></figure>
                      <div class="box text-center">

                          <h4 class="post-title"><a href="{{ url("photoroom", $data['id']) }}">{{ str_limit($data['title'],20) }}</a></h4>
                          <br>
                      </div>
                      <!-- /.box -->
                  </div>
                  <!-- /.post -->
                  @endforeach



              </div>
              <!--/.carousel -->
          </div>
          <!--/.carousel-wrapper -->
          <!-- Large modal -->
          <div class="divide30"></div>
          <div id="js-grid-mosaic-more" class="cbp-l-loadMore-text">
              <a href="#!" data-toggle="modal" data-target=".bs-example-modal-lg" class="cbp-l-loadMorelink btn"
                 rel="nofollow">
                  <span class="cbp-l-loadMore-defaultText">заказать фотосессию сейчас</span>
              </a>
          </div>

      </div>
      <!--/.container -->

  </div>
  <!-- /.dark-wrapper -->



@include('incomes.order')

@stop

@section('home')
    <div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-9">
        <div id="preloader">
            <div class="textload">Загрузка</div>
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="portfolio-item-detail-header">
            <img src="" alt="">
            <h2 class="text-center title"></h2>
        </div>
        <div class="slide-portfolio-item-detail">

            <!-- .inner -->
        </div>
        <!-- slide-portfolio-item-detail -->
    </div>
    <!-- slide-portfolio-item-content -->
@stop
@section('footer')

<script>



    $(function(){



        var $container = $('.isotop');

        $container.imagesLoaded(function(){
            $container.masonry({
                itemSelector: '.ggg',
                columnWidth: 100
            });
        });

        $container.infinitescroll({
                    navSelector  : '.pagination1',    // селектор контейнера для навигации по старинцам
                    nextSelector : '.pagination li a:last-child',  // селектор для навигации
                    itemSelector : '.ggg',     // селектор блоков, к которым применяются эффекты
                    donetext  : 'Больше нет страниц для загрузки!',
                    debug: false, // выводит ошибки на консоль
                    errorCallback: function() {
                        // сообщение об ошибках исчеазет по истечении 2 секундной анимации
                        $('#infscr-loading').animate({opacity: .8},2000).fadeOut('normal');
                    }
                },
                // вызываем Masonry
                function( newElements ) {
                    var $newElems = $( newElements );
                    // запускаем эффекты только после полной загрузки изображений
                    $newElems.imagesLoaded(function(){
                        $container.masonry( 'appended', $newElems, true );
                    });
                }
        );

    });



</script>
@stop


