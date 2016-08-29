@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>{{ $data['name'] }}</h2>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content mailbox-content">
                                <div class="file-manager">
                                    <a class="btn btn-block btn-primary compose-mail" href="#!">Принять заказ</a>
                                    <div class="space-25"></div>

                                    @foreach( $location as $i )
                                    <h5>{{ $i['title'] }}</h5>
                                    @endforeach
                                    <ul class="category-list" style="padding: 0">
                                        <?
                                        function percent1($price, $discount) {
                                            $per = $price/100;
                                            $r = $per*$discount;
                                            return $price-$r;
                                        }
                                        ?>

                                        @foreach($time as $t)
                                            <? $price = percent1($t['price'],$t['discount']) ?>
                         <li><a href="#"> <i class="fa fa-calendar text-navy"></i><b>{{ $t['time'] }}</b> / <i class="fa fa-money text-navy"></i><b><? print $price ?></b> гривен</a></li>
                                                <hr>

                                        @endforeach

                                    </ul>


                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 animated fadeInRight">
                        <div class="mail-box-header">

                            <h2>
                                Дополнительная информация
                            </h2>
                            <div class="mail-tools tooltip-demo m-t-md">


                                <h5>
                                    {{--<span class="pull-right font-noraml">10:15AM 02 FEB 2014</span>--}}
                                    <p>Электронный адрес <span class="font-noraml"><i class="fa fa-envelope"></i> </span>{{ $data['email'] }}</p>
                                    <p>Номер телефона <span class="font-noraml"><i class="fa fa-phone"></i> </span>{{ $data['phone'] }}</p>

                                </h5>
                            </div>
                        </div>
                        <div class="mail-box">


                            <div class="mail-body">

                                @if(!$data['note'])
                                    <p>Примечаний не оставили!</p>
                                @else
                                    {!! $data['note'] !!}
                                @endif

                            </div>


                            <div class="clearfix"></div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@stop
@section('footer')
    <script>

        $(document).ready(function() {
            $('.summernote').summernote();
        });

        $(document).ready(function(){
            var progressBar = $('#pb');
            $("#form").submit(function(){
                event.preventDefault()

                var data = new FormData();
                $.ajax({
                    type: 'POST',

                    url: "",
                    data: new FormData( this ),
                    success: function(data){
                        swal({
                            title: "Готово!",
                            text: "Все сделали, все загрузили и создали! Добавим еще, что - то?",
                            type: "success",
                            showCancelButton: false,
                            closeOnConfirm: true,
                            animation: "slide-from-top",
                            inputPlaceholder: "Write something"
                        });
                        $('#form').trigger( 'reset' );
                       // window.location = "/dashboard/equipment/list";

                    },
                    error: function (data) {
                        swal({
                            type: "error",
                            title: "Oops! Ошибка",
                            text: data.responseJSON.file + " Если ошибка не исчезает - пиши Андрею, он ждет :)",
                            timer: 5000,
                            closeOnConfirm: true,
                        });
                        //document.write();
                        console.log(data.responseJSON.file);
                        //alert(data.responseText);

                    },
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
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
                    processData: false,
                });

            });
        });


    </script>

@stop