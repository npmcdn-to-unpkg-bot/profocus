@extends('template')

@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>
    <div class="light-wrapper">
            <img src="{{ url($model['thumbnail_wide']) }}" alt="">
        <!-- /.container -->
        <div class="container inner">
            <div class="row options">

                <div class="col-lg-12 col-md-12 col-sm-12 "><h2 class="modelName text-left title">{{ $model['name'] }}</h2></div>
                <div class="col-lg-12 col-md-12 col-sm-12 bust">Грудь: {{ $model['bust'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 waist">Талия: {{ $model['waist'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 hips">Бедра: {{ $model['hips'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 stature">Рост: {{ $model['stature'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 dress">Размер платья: {{ $model['dress'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 shoe">Размер обуви: {{ $model['shoe'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 hair">Цвет волос: {{ $model['hair'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 eyes">Цвет глаз: {{ $model['eyes'] }}</div>
                <div class="col-lg-12 col-md-12 col-sm-12 hidden">
                    <a href="" class="" style="display: block;bac1kground: #e7e7e7; padding: 20px;">Подробнее</a>
                </div>
            </div>


        </div>
    </div>
    <!-- /.light-wrapper -->
    <!-- /.light-wrapper -->
    <div class="dark-wrapper">
        <div class="container inner">
            <div class="row">
                       <div class="col-sm-12 col-lg-12 col-xs-12">
                           <h2>{{ $model['name'] }}</h2>
                           {!! $model['about'] !!}
                       </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.light-wrapper -->

    <div class="light-wrapper">
        <div class="container inner2">
            <div class="divide30"></div>
            <div class="row isotope">
                @foreach($files as $img)

                    <div class="col-sm-6 col-md-4 item" style="padding: 1px !important;">

                        <a href="{{ url($img['image']) }}" class="fancybox">

                            <img src="{{ url($img['thumb']) }}" alt="" />
                            <!-- /.box -->
                        </a>

                    </div>

            @endforeach
            <!-- slide-portfolio -->
            </div>
        </div>
        <!-- /.container -->
        <div class="pagination1" style="display: none">
            <?php echo $files->render(); ?>
        </div>
    </div>
    <!-- /.dark-wrapper -->



@stop

@section('model')
    <div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-9">
        <div id="preloader">
            <div class="textload">Загрузка</div>
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="slide-portfolio-item-detail">
            <div class="inner2">
                <h2 class="text-center title"></h2>
                <div class="text-center model-more"></div>
                <div class="divide25"></div>
                <p><a href="">Подробнее</a></p>
                <div class="row options">
                    <div class="col-lg-12 col-md-12 col-sm-12 bust"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 waist"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hips"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 stature"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 dress"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 shoe"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 hair"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12 eyes"></div>
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

            $(".fixed300").niceScroll();

            $(".fancybox").fancybox({
                openEffect	: 'none',
                closeEffect	: 'none',
                padding: 0
            });
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
                            });
                        }
                );

            });

            $('.show-model').on('click', function (e) {

                var id = $(this);
                var parsedId = id.data('model');
                var url = id.attr('href');


                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('models/singleModel') }}"+"/"+parsedId,
                    data: {"id" : parsedId},
                    success: function(data) {
                        $('.slide-portfolio-item-detail').find('.title').text(data['name']);
                        $('.slide-portfolio-item-detail').find('a').attr('href',url);

                        $('.slide-portfolio-item-detail').find('.model-more').html( '<a href="models" + '/' + parsedId>Подробнее</a>' );
                        $('.slide-portfolio-item-detail').find('.bust').text("Грудь: " + data['bust']);
                        $('.slide-portfolio-item-detail').find('.waist').text("Талия: " + data['waist']);
                        $('.slide-portfolio-item-detail').find('.hips').text("Бедра: " + data['hips']);
                        $('.slide-portfolio-item-detail').find('.dress').text("Размер платья: " + data['dress']);
                        $('.slide-portfolio-item-detail').find('.shoe').text("Размер обуви: " + data['shoe']);
                        $('.slide-portfolio-item-detail').find('.hair').text("Цвет волос: " + data['hair']);
                        $('.slide-portfolio-item-detail').find('.eyes').text("Цвет глаз: " + data['eyes']);
                        $('.slide-portfolio-item-detail').find('.stature').text("Рост: " + data['stature']);

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
