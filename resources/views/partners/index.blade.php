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
        <div class="container inner discounts">

            <div class="divide30"></div>
            <div id="slide-portfolio" class="image-grid col3">
                <div class="items-wrapper">
                    <ul class="isotope items">
                        @foreach( $data as $partner )
                            <div class="item ">
                                <figure class="icon-overlay">
                                    <a href="" data-type="slide-portfolio-item-9" class="show-more" data-partner="{{ $partner['id'] }}">
                                        <img src="{{ $partner['thumbnail'] }}" alt="" />
                                    </a>
                                </figure>
                                <div class="slide-portfolio-item-info box">
                                    <h4 class="post-title">{{ $partner['title'] }}</h4>
                                </div>
                            </div>
                        @endforeach
                    </ul>

                </div>
                <!--/.items-wrapper -->
            </div>
            <!-- slide-portfolio -->



            <!-- /column -->


            <div class="pagination1" style="display: none">
                <?php echo $data->render(); ?>
            </div>
        </div>
        <!-- /.container -->
    </div>
@stop
@section('discount')
    <div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-9">
        <div id="preloader">
            <div class="textload">Загрузка</div>
            <div id="status">
                <div class="spinner"></div>
            </div>
        </div>
        <div class="slide-portfolio-item-detail">
            <div class="inner2">

                <h2 class="title"></h2>
                <div class="text-center model-more"></div>
                <div class="divide25"></div>
                <h4 class="start"></h4>
                <h4 class="discount"></h4>
                <div class="divide25"></div>
                <div class="body"></div>

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
            $('.post-title a').on("click", function (){
                return false
            });

            $('.show-more').on('click', function (e) {

                var id = $(this);
                var parsedId = id.data('partner');
                var url = id.attr('href');


                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('partners/singlePartners') }}"+"/"+parsedId,
                    data: {"id" : parsedId},
                    success: function(data) {
                        console.log(data);
                        var options = {
                            month: 'long',
                            day: 'numeric',
                            weekday: 'long',
                            timezone: 'UTC',

                        };





                        $('.slide-portfolio-item-detail').find('.title').text(data['title']);
                        $('.slide-portfolio-item-detail').find('.body').html(data['body']);





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
        });
    </script>
@stop