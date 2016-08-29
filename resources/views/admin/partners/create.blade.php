@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Добавляем партнера</h2>
                    <span>Здесь мы будем добавлять нового партнера!</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/partners/list') }}"><b>К списку партнеров</b></a></span>

                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                {!! Form::open(['url'=>'dashboard/partners/new','files'=>true, 'method' => 'POST', 'class'=> "form-horizontal", 'id' => 'form' ]) !!}



                                <div class="row">

                                    <div class="col-lg-9">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Партнер</span>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Собственно о партнере.</span>
                                                {!! Form::textarea('body',null,['class'=>"form-control summernote ",'id'=>'editor1']) !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 right-side-group">
                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                    <input type="file" name="thumbnail" id="inputImage" class="hide">
                                                    Логотип
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide"></button>
                                                    Добавить!
                                                </label>
                                                <div class="progress" >
                                                    <div id="pb" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-default">
                                                    </div>
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

                        $('.summernote').summernote({
                            height: 300
                        });
                        var progressBar = $('#pb');
                        $("#form").submit(function(event){
                            event.preventDefault();
                            var data = new FormData();
                            $.ajax({
                                type: 'POST',
                                url: 'new',
                                data: new FormData( this ),
                                success: function(url) {
                                    toastr.success( "Добавлено!" );
                                    $('.back-to-list').css("display","block");
                                    $('#form').trigger('reset');
                                    $('.summernote').summernote('code','');
                                    $('#pb').css( "width", "0%" ).attr('aria-valuemax', 0);
                                    $('#pb').text("");
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


                </script>

@stop
