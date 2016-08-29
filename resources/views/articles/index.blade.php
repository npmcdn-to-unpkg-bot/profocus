@extends('template')

@section('title')
    {{--{{ $page[0]['title'] }}--}}
@stop

@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>

    {{--<div class="light-wrapper">--}}
        {{--<div class="container inner">--}}

            {{--<h3 class="section-title ">--}}
                {{--{{ $page[0]['title'] }}--}}
            {{--</h3>--}}
            {{--<div class="morer">--}}
                {{--{!! $page[0]['body'] !!}--}}
            {{--</div>--}}

        {{--</div>--}}
        {{--<!-- /.container -->--}}
    {{--</div>--}}
    <!-- /.light-wrapper -->





    <div class="dark-wrapper">
        <div class="container inner2">
            <div class="blog grid-view col3">
                <div class="blog-posts text-boxes">

                    <div class="isotop row">

                        @foreach( $articles as $article )

                            <div class="col-sm-6 col-md-4 ggg">
                                <div class="post">
                                    <figure class="main"><a href="{{ url("/post/" . $article['id']) }}">
                                            <img src="{{ $article['thumbnail'] }}"  alt=""></a></figure>
                                    <div class="box text-center">
                                        <div class="category cat9"><span><a href="javascript:return false;">Новости</a></span></div>
                                        <h4 class="post-title"><a href="{{ url("/post/" . $article['id']) }}" title="{{ $article['title'] }}">{{ str_limit($article['title'],25) }}</a></h4>
                                        <div class="meta">
                    <span class="date">
                    {{ $article['date'] }}
                    </span>
                                        </div>

                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <!-- /column -->

                        @endforeach


                    </div>
                    <!-- /.isotope -->
                </div>
                <!-- /.blog-posts -->
                <div class="pagination1" style="display: none">
                    <?php echo $articles->render(); ?>
                </div>

            </div>
            <!-- /.blog -->
        </div>
        <!--/.container -->
    </div>
    <!-- /.pagination -->


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


