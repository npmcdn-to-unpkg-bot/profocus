@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Обновляем материал!</h2>
                    <span>Здесь мы будем обновлять материал</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/stuff') }}"><b>К списку материалов</b></a></span>

                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                {!! Form::model( $stuff, ['files'=>'true', 'class'=> "form-horizontal", 'id' => 'form' ]) !!}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <span class="help-block m-b-none">Заголовок</span>
                                        {!! Form::text('title',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <span class="help-block m-b-none">Текст</span>
                                        {!! Form::textarea('body',null,['class'=>'form-control summernote']) !!}

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-12">

                                        <label title="Donload image" id="download" class="btn btn-primary">
                                            <button type="submit" class="hide"></button>
                                            Сохранить!
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


                    $(document).ready(function() {
                        $('.summernote').summernote();
                    });

                    $(document).ready(function(){
                        var progressBar = $('#pb');
                        $("#form").submit(function(event){
                            event.preventDefault();

                            var data = new FormData();
                            $.ajax({
                                type: 'POST',

                                url: "{{ url( "dashboard/stuff/edit",$stuff['id'])  }}",
                                data: new FormData( this ),
                                success: function(data){
                                    toastr.success( "Обновлено!" );
                                    $('.back-to-list').css("display","block");
                                    $('#pb').css( "width", "0%" ).attr('aria-valuemax', 0);
                                    $('#pb').text("");
                                    //window.location = "/dashboard/article/list";

                                },
                                error: function (data) {

                                    var errors = data.responseJSON;
                                    var errorsHtml= '';
                                    $.each( errors, function( key, value ) {
                                        errorsHtml += '<li>' + value[0] + '</li>';
                                    });
                                    toastr.error( errorsHtml , "Ошибка " + data.status );
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