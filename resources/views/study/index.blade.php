@extends('template')

@section('title')

        {{ $page[0]['title'] }}

@stop
@section('content')
    <? if( request()->route()->getName() != 'home' ) echo '<div class="offset" style="padding-top: 90px;"></div>'; ?>
    <div class="dark-wrapper">
        <div class="container inner discounts">

            <div class="divide30"></div>
            <div class="row">

                <div class="col-lg-8">
                    {!! $page[0]['body'] !!}
                </div>

                <div class="col-lg-4">
                    <h3 class="section-title">Заявка на курсы</h3>
                    <div class="form-container">
                        <form method="post" id="form" class="">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-field">
                                        <label>
                                            <input type="text" name="name" placeholder="Имя">
                                        </label>
                                    </div>
                                    <!--/.form-field -->
                                </div>
                                <!--/column -->
                                <div class="col-sm-12">
                                    <div class="form-field">
                                        <label>
                                            <input type="text"  name="email" placeholder="Email">
                                        </label>
                                    </div>
                                    <!--/.form-field -->
                                </div>
                                <!--/column -->
                                <div class="col-sm-12">
                                    <div class="form-field">
                                        <label>
                                            <input type="text" name="phone" placeholder="Мобильный телефон">
                                        </label>
                                    </div>
                                    <!--/.form-field -->
                                </div>
                                <!--/column -->
                                <div class="col-sm-12">
                                    <div class="form-field">
                                        <label class="custom-select">
                                            <select name="course">
                                                <option value="">Выбрать курс</option>
                                                @foreach( $course as $data )
                                                    <option value="{{ $data['id'] }}">{{ $data['title'] }}</option>
                                                @endforeach
                                            </select>
                                            <span><!-- fake select handler --></span>
                                        </label>
                                    </div>
                                    <!--/.form-field -->
                                </div>
                                <!--/column -->
                            </div>
                            <!--/.row -->
                            <textarea name="body" placeholder="Примечание"></textarea>

                            <input type="submit" class="btn state-initial" value="Отправить зявку" data-error="Fix errors" data-processing="Sending..." data-success="Thank you!" data-initial="Send">
                            <footer class="notification-box"></footer>
                        </form>
                        <!--/.vanilla-form -->
                    </div>

                </div>

            </div>





            <!-- /column -->


            <div class="pagination1" style="display: none">
                <?php //echo $data->render(); ?>
            </div>
        </div>
        <!-- /.container -->
    </div>

    <div class="light-wrapper">
        <div class="container inner2">
            <div class="divide30"></div>
            <div id="slide-portfolio" class="image-grid col3">
                <div class="items-wrapper">
                    <ul class="isotope items">
                        @foreach( $course as $item )
                        <div class="item ">
                            <figure class="icon-overlay">
                                <a href="{{ url('courses', $item['id']) }}" data-type="slide-portfolio-item-9" class="show-course" data-course="{{ $item['id'] }}">
                                    <img src="{{ $item['thumbnail'] }}" alt="" />
                                </a>
                            </figure>
                            <div class="slide-portfolio-item-info box">
                                <h4 class="post-title">{{ str_limit($item['title'], 20) }}</h4>
                            </div>
                        </div>
                        @endforeach
                    </ul>

                </div>
                <!--/.items-wrapper -->
            </div>
            <!-- slide-portfolio -->

        </div>
        <!-- /.container -->
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
                <b class="price_under_title"></b>
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

            $('.show-course').on('click', function(e){
                var id = $(this).data('course');

                event.preventDefault(e);
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('study/singleCourse') }}/"+id,
                    success: function(data) {
                        console.log(data);
                        $('.slide-portfolio-item-detail').find('.title').text(data['title']);
                        $('.slide-portfolio-item-detail').find('.price_under_title').text("Цена курса: " + data['price'] + "грн");
                        $('.slide-portfolio-item-detail').find('.body').html(data['about']);
                        $('.slide-portfolio-item-detail').find('.bust').text("Грудь: " + data['bust']);
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        var errorsHtml= '';
                        $.each( errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        swal({
                            type: "error",
                            title: "Ошибка!",
                            text: "Заполните все поля!",
                            showConfirmButton: true,
                            showCancelButton: false,
                            closeOnConfirm: false,
                        });
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
                        }, 3000);
                    },
                    contentType: false,
                    processData: false,

                })
            });


            $('#form').submit(function (e) {
                event.preventDefault(e);
                $.ajax({
                    cache: false,
                    type: 'POST',
                    url: "{{ url('study') }}",
                    data: new FormData(this),
                    success: function(data) {
                        //console.log(data);
                        $("#form").trigger("reset");
                        swal({
                            title: "Успех!",
                            text: "Заявка обрабатывается",
                            timer: 1000,
                            showConfirmButton: false,
                            showCancelButton: false,
                            closeOnConfirm: false,
                        });
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        var errorsHtml= '';
                        $.each( errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        swal({
                            type: "error",
                            title: "Ошибка!",
                            text: "Заполните все поля!",
                            showConfirmButton: true,
                            showCancelButton: false,
                            closeOnConfirm: false,
                        });
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
                    },
                    contentType: false,
                    processData: false,

                })});

        });
    </script>
@stop