@extends('admin')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-globe text-navy mid-icon"></i>
                        </div>
                        <h2>Модели</h2>
                        <a href="{{ url('dashboard/models/new') }}">Добавить новую</a>
                    </div>
                </div>

                <div class="ibox-content forum-container" >
                    <div class="isotop row ">

                @foreach( $models as $model )


                            <div class="col-lg-4 ggg">
                                <img alt="image" width="100%" class="" src="{{ url($model['thumbnail']) }}">

                                <div class="contact-box">
                                    <a href="profile.html">
                                        <div class="col-sm-12">

                                        </div>
                                        <div class="col-sm-8">
                                            <h3><a href="{{ url('dashboard/models/edit',$model['id'] ) }}"><strong>{{ $model['name'] }}</strong></a></h3>
                                            <a href="{{ url('dashboard/models/delete',$model['id'] ) }}" >Удалить <i class="fa fa-trash"></i> </a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>


                @endforeach

                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pagination1" style="displ1ay: none">
        <?php echo $models->render(); ?>
    </div>





@stop

@section('footer')
    <script>

        var $container = $('.isotop');

        $container.imagesLoaded(function(){
            $container.masonry({
                // options
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
                function( newElements ) {
                    var $newElems = $( newElements );
                    // запускаем эффекты только после полной загрузки изображений
                    $newElems.imagesLoaded(function(){
                        $container.masonry( 'appended', $newElems, true );
                    });
                });

    </script>
    @stop