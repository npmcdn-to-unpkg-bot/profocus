@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Новый курс! </h2>
                    <span>Здесь мы будем добавлять курсы</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/study/list') }}"><b>К списку курсов</b></a></span>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                {!! Form::open(['files'=>'true', 'class'=> "form-horizontal", 'id' => 'form' ]) !!}


                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Заголовок</span>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Цена</span>
                                                <input type="text" name="price" class="form-control price">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Текст</span>
                                                <textarea name="body" class="form-control summernote"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 right-side-group">
                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                    <input type="file" name="thumbnail" id="inputImage" class="hide">
                                                    370x550
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide"></button>
                                                    Готово
                                                </label>

                                                <div class="progress" >
                                                    <div id="pb" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-default"></div>
                                                </div>
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


        $(document).ready(function() {
//            $('.price').inputmask({mask: "99-99-9999"});
            $('.summernote').summernote({
                height: 200

            });

            $('#form').on('submit',function(event){
                var progressBar = $('#pb');
                event.preventDefault();
                $.ajax({
                    data: new FormData(this),
                    type: "POST",
                    url: "{{ url('dashboard/study/new') }}",
                    cache: false,
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    success: function(data){
                        toastr.success( "Добавлено!" );
                        $('#form').trigger('reset');
                        $('.summernote').summernote('code','');
                        $('.back-to-list').css("display","block");
                        $('#pb').css( "width", "0%" ).attr('aria-valuemax', 0);
                        $('#pb').text("");

                    },
                    error: function (data) {
                        console.log(data);
                        var errors = data.responseJSON;
                        var errorsHtml= '';
                        $.each( errors, function( key, value ) {
                            errorsHtml += '<li>' + value[0] + '</li>';
                        });
                        toastr.error( errorsHtml , "Ошибка " + data.status );
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





    </script>

@stop