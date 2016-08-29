@extends('template')

{{--@section('title')--}}
    {{--@foreach( $page as $info )--}}
        {{--{{ $info['title'] }}--}}
    {{--@endforeach--}}
{{--@stop--}}

@section('content')
    <?
    if( request()->route()->getName() != 'home' )
    {
        echo '<div class="offset" style="padding-top: 90px;"></div>';
    }
    ?>
<div class="dark-wrapper">
    <div class="container inner2">
        <div class="col-sm-12 blog-content">
            <div class="blog-posts classic-view">

                <div class="post">
                    <div class="box text-center">

                        <h1 class="post-title">
                            {{ $item['title']  }}
                        </h1>
                        <div class="meta">
                            <span class="date">{{ $item['date']  }}</span>
                        </div>

                        <div class="post-content text-left">
                        {!! $item['body'] !!}

                        </div>
                        <!-- /.post-content -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- .post -->
            </div>
            <!-- /.classic-view -->
        </div>
    </div>
</div>
    <div class="dark-wrapper">
        <div class="container inner2">
            <div class="blog grid-view col3">
                <div class="blog-posts text-boxes">
                    <div class="isotope row">
                            @foreach($files as $img)
                                <div class="col-sm-6 col-md-4 ggg" style="padding: 1px !important;">
                                        <a href="{{ url($img['image']) }}" class="fancybox">
                                        <img src="{{ url($img['thumb']) }}" alt="" />
                                        <!-- /.box -->
                                        </a>
                                </div>
                            @endforeach
                    </div>
                    <!-- /.isotope -->
                </div>
                <!-- /.blog-posts -->
                <div class="pagination1">
                    <?php echo $files->render(); ?>
                </div>

            </div>
            <!-- /.blog -->
        </div>
        <!--/.container -->
    </div>
@stop
@section('footer')
    <script>

        $(document).ready(function(){

            $(".fancybox").fancybox({
                openEffect	: 'none',
                closeEffect	: 'none',
                padding: 0
            });
            $(function(){
                var $container = $('.isotope');
                $container.imagesLoaded(function(){
                    $container.masonry({
                        itemSelector: '.ggg',
                        columnWidth: '.ggg'
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


        })
    </script>
@stop