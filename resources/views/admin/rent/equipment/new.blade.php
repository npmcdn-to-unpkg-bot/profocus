@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Добавляем оборудование!</h2>
                    <span>Размер картинки должен быть <b>370 Х 246</b></span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/equipment/list') }}"><b>К списку оборудования</b></a></span>

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
                                        <span class="help-block m-b-none">Название</span>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>


                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" name="thumbnail" id="inputImage" class="hide">
                                            Картинка
                                        </label>
                                        <label title="Donload image" id="download" class="btn btn-primary">
                                            <button type="submit" class="hide"></button>
                                            Сохранить!
                                        </label>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="progress" >
                                            <div id="pb" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-default">

                                            </div>
                                        </div>
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
            $("#form").submit(function(event){
                event.preventDefault();
                var data = new FormData();
                $.ajax({
                    type: 'POST',
                    url: 'new',
                    data: new FormData( this ),
                    success: function(data){
                        toastr.success( "Добавлено!" );
                        $('.back-to-list').css("display","block");
                        $('#form').trigger('reset');
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
                    processData: false
                });
            });
        });

        $('.summernote').summernote({
            height: 300
        })
    </script>

@stop
