@extends('template')

@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>
    <div class="container-fluid hidden-xs hidden-sm">
        <div class="row">
            <div class="col-lg-12 col-md-12 hidden-xs hidden-sm" style="padding: 0 !important;">
                <img src="{{ url($category['wide_bg']) }}" alt="">

            </div>
            <div class="col-lg-12 col-md-12 hidden-xs hidden-sm">
                <div id="js-filters-mosaic" class="cbp-filter-container text-center">


                </div>

            </div>

        </div>
    </div>
    <!-- /.light-wrapper -->

    <div class="light-wrapper">
        <div class="container inner">

            <div class="row">

                <div class="col-lg-4 col-md-6 hidden-sm hidden-xs">
                    <br>

                    <img src="../images/hh.png" style="display:block; margin:auto;" width1="100%" alt="">
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                   {!! $category['about'] !!}
                </div>

            </div>

            <div class="divide30"></div>
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
        <div class="container inner2">
            <div class="divide30"></div>
            <div id="slide-portfolio" class="image-grid col3">
                <div class="items-wrapper">
                    <div class="isotope items">
                    @foreach($sessions as $data)
                        <ul class="item col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <figure class="icon-overlay">
                                    <a href="" data-type="slide-portfolio-item-8" class="show-model" data-model="{{ $data['id'] }}">
                                        <img src="{{ url($data['thumbnail']) }}" alt="" />
                                    </a>
                                </figure>
                                <div class="slide-portfolio-item-info box">
                                    <h4 class="post-title">{{ $data['title'] }}</h4>
                                </div>
                            </ul>
                    @endforeach


                    </div>

                </div>
                <!--/.items-wrapper -->
            </div>
            <!-- slide-portfolio -->

        </div>
        <!-- /.container -->
        <!--/.container -->
    </div>
    <!--/.dark-wrapper -->

    @include('incomes.order')


@stop
@section('model')
    <div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-8">
        {{--<div id="preloader">--}}
            {{--<div class="textload">Загрузка</div>--}}
            {{--<div id="status">--}}
                {{--<div class="spinner"></div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="slide-portfolio-item-detail">
            <div class="inner2">
                <h2 class="title">Фотодни в песках</h2>

                <div class="divide30"></div>
                <p class="text-center">
                    <ul>
                    <li class="single-date">Дата: 23.07.2016</li>
                    <li class="single-title">Название: Фотодни в песках</li>
                    <li class="single-photo">Фотограф: Антон Чехов</li>
                    <li class="single-location">Локация: Киевская Пустыня</li>
                    <li class="single-makeup">Мейк: G.Bar</li>
                    <li class="single-hair">Укладка: G.Bar</li>
                    </ul>
                    <div class="single-about"></div>
                </p>
                <p class="text-center"></p>
                <p class="text-center"></p>
                <p class="text-center"></p>


                <div class="divide25"></div>



                        <div class="blog grid-view col3">
                            <div class="blog-posts text-boxes">


                                <div class="isotope row side_gallery">

                                </div>
                                <!-- /.isotope -->
                            </div>
                            <!-- /.blog-posts -->


                        </div>
                        <!-- /.blog -->
                    <!--/.container -->



            </div>

        </div>


        <!-- slide-portfolio-item-detail -->
    </div>
    <!-- slide-portfolio-item-content -->
@stop


@section('footer')
    <script>
        $(document).ready(function(){


            $('body').on('click', '.show-model', function (e) {

                var id = $(this);
                var parsedId = id.data('model');
                var url = id.attr('href');

                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('photoroom/single') }}"+"/"+parsedId,
                    data: {"id" : parsedId},
                    success: function(data) {
                        console.log(data[0]);

                        $('.slide-portfolio-item-detail').find('.single-date').text("Дата: " + data[1]['date']);
                        $('.slide-portfolio-item-detail').find('.title').text(data[1]['title']);
                        $('.slide-portfolio-item-detail').find('.single-title').text("Название: " + data[1]['title']);
                        $('.slide-portfolio-item-detail').find('.single-photo').text("Фотограф: " + data[1]['photographer']);
                        $('.slide-portfolio-item-detail').find('.single-location').text("Локация: " + data[1]['location']);
                        $('.slide-portfolio-item-detail').find('.single-makeup').text("Мейк: " + data[1]['makeup']);
                        $('.slide-portfolio-item-detail').find('.single-hair').text("Укладка: " + data[1]['hair']);
                        $('.slide-portfolio-item-detail').find('.single-about').html( data[1]['about']);


                        var galery = '';
                        var itemGalery = '';

                        for (var i=0; i< data[0].length; i++){

                            itemGalery = '<div class="col-sm-6 col-md-4 ggg" style="padding: 1px !important;"> \
                                        <a href="../' + data[0][i]['image'] + '"  class="fancybox"> \
                                            <img src="../' + data[0][i]['thumb'] + '" alt="" /> \
                                        </a> \
                                    </div>';
                            
                            galery += itemGalery;
                        }

                        $('.side_gallery').append(galery);
                         var $container = $('.side_gallery');

                        $container.imagesLoaded(function(){
                            $container.masonry({
                                itemSelector: '.ggg',
                                columnWidth: '.ggg'
                            });
                        });

                        $('.fancybox').fancybox();


                        


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
