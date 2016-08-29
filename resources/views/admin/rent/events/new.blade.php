@extends('admin')


@section('content')


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row wrapper border-bottom white-bg page-heading">
                                    <div class="col-lg-10">
                                        <h2>Дата!</h2>
                                        <span>Ставим скидку или цену на день, время!</span>
                                    </div>
                                    <div class="col-lg-2">

                                    </div>
                                </div>
                                <div class="wrapper wrapper-content animated fadeInRight">


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox float-e-margins">

                                                <div class="ibox-content">

                                                    {!! Form::open(['url'=>'dashboard/article/new','files'=>true, 'method' => 'POST', 'class'=> "form-horizontal", 'id' => 'form' ]) !!}

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            {!! Form::date('Date',null,['class'=>'form-control','placeholder'=>'Скидка']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            {!! Form::text('Discount',null,['class'=>'form-control','placeholder'=>'Скидка']) !!}
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <label title="Donload image" id="download" class="btn btn-primary">
                                                                <button type="submit" class="hide"></button>
                                                                Готово!
                                                            </label>
                                                        </div>
                                                    </div>

                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
@stop

@section('footer')
    <script>

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
                        //window.location = "/dashboard/article/list";

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

