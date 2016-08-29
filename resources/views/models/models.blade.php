@extends('template')
@section('title')
        {{ $page[0]['title'] }}
@stop
@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>
    <div class="light-wrapper">
        <div class="container inner">

                <h3 class="section-title ">{{ $page[0]['title'] }}</h3>
                <div class="morer">
                    {!! $page[0]['body'] !!}
                </div>

        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->

        <div class="dark-wrapper">
            <div class="container inner2">
                <div class="divide30"></div>

                <div class="row">
                <div id="slide-portfolio" class="image-grid col3">
                    <div class="items-wrapper">
                        <ul class="isotope items">
                            @foreach( $models as $model )

                            <div class="item col-lg-4">
                                <figure class="icon-overlay">
                                    <a href="{{ url('models', $model['id']) }}" data-type="slide-portfolio-item-9" class="show-model" data-model="{{ $model['id'] }}">
                                        <img src="{{ $model['thumbnail'] }}" alt="" />
                                    </a>
                                </figure>
                                <div class="slide-portfolio-item-info box">
                                    <h4 class="post-title">{{ $model['name'] }}</h4>
                                </div>
                            </div>
                            @endforeach
                        </ul>

                    </div>
                    <!--/.items-wrapper -->
                </div>
                <!-- slide-portfolio -->
                </div>
            </div>
            <!-- /.container -->

        </div>
        <!-- /.dark-wrapper -->
    <div class="pagination1" style="display: none">
        <?php echo $models->render(); ?>
    </div>

@stop

@section('model')
    <div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-9">
        <div id="preloader">
            <div class="textload">Загрузка</div>
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="portfolio-item-detail-header">
            <img src="" alt="">

        </div>
        <div class="slide-portfolio-item-detail">

            <div class="inner2">
                <div class="text-center model-more"></div>
                <div class="divide25"></div>
                <div class="row options">

                    <div class="col-lg-12 col-md-12 col-sm-12 "><h2 class="modelName text-left title">asdasd</h2></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 bust"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 waist"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hips"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 stature"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 dress"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 shoe"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hair"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 eyes"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <a href="" class="" style="display: block;bac1kground: #e7e7e7; padding: 20px;">Подробнее</a>
                    </div>
                </div>

            </div>
            <!-- .inner -->
        </div>
        <!-- slide-portfolio-item-detail -->
    </div>
    <!-- slide-portfolio-item-content -->
@stop

@section('footer')
    <script>
        $(document).ready(function(){
            $(function(){

                var $container = $('.isotope');

                $container.imagesLoaded(function(){
                    $container.masonry({
                        itemSelector: '.item',
                        columnWidth: '.item'
                    });
                });

                $container.infinitescroll({
                            navSelector  : '.pagination1',    // селектор контейнера для навигации по старинцам
                            nextSelector : '.pagination li a:last-child',  // селектор для навигации
                            itemSelector : '.item',     // селектор блоков, к которым применяются эффекты
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

                                var le = $(".icon-overlay a:not(:has(span))");

                                for (var i=0; i<le.length; i++){
                                    $(le[i]).prepend('<span class="icn-more"></span>');
                                }
                                /*
                                 if ( le == 0 )
                                 $('.icon-overlay a').prepend('<span class="icn-more"></span>');
                                 */


                                slidePortf();
                            });
                        }
                );

            });

            $('body').on('click', '.show-model', function (e) {

                var id = $(this);
                var parsedId = id.data('model');
                var url = id.attr('href');


                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('models/singleModel') }}"+"/"+parsedId,
                    data: {"id" : parsedId},
                    success: function(data) {
                        console.log(data);
                        $('.slide-portfolio-item-detail').find('.title').text(data['name']);
                        $('.slide-portfolio-item-detail').find('a').attr('href',url);
                        $('.portfolio-item-detail-header').find('img').attr('src',data['thumbnail_wide']);

                        $('.slide-portfolio-item-detail').find('.model-more').html( '<a href="models" + '/' + parsedId>Подробнее</a>' );
                        $('.slide-portfolio-item-detail').find('.bust').text("Грудь: " + data['bust']);
                        $('.slide-portfolio-item-detail').find('.waist').text("Талия: " + data['waist']);
                        $('.slide-portfolio-item-detail').find('.hips').text("Бедра: " + data['hips']);
                        $('.slide-portfolio-item-detail').find('.stature').text("Рост: " + data['stature']);
                        $('.slide-portfolio-item-detail').find('.dress').text("Размер платья: " + data['dress']);
                        $('.slide-portfolio-item-detail').find('.shoe').text("Размер обуви: " + data['shoe']);
                        $('.slide-portfolio-item-detail').find('.hair').text("Цвет волос: " + data['hair']);
                        $('.slide-portfolio-item-detail').find('.eyes').text("Цвет глаз: " + data['eyes']);

                    },
                    error: function (data) {
                        alert('error');
                    },
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');
                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    complete: function(){
                        setTimeout(function(){
                            $('.slide-portfolio-item-content').find('#preloader').hide();
                        }, 1000);
                    }

                })});
        })
    </script>
@stop
