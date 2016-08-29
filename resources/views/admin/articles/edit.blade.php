@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Обновляем пост!</h2>
                    <span>Здесь мы будем обновлять новости</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/articles/list') }}"><b>К списку категорий</b></a></span>

                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                {!! Form::model($article,['files'=>'true', 'class'=> "form-horizontal", 'id' => 'form'
                                ]) !!}


                               <div class="row">

                                   <div class="col-lg-9">
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
                                   </div>




                               <div class="col-lg-3">

                                   <div class="form-group">
                                       <div class="col-sm-12 right-side-group">
                                           <img width="100%" src="{{ url($article['thumbnail']) }}" alt="">
                                           <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                               <input type="file" name="thumbnail" id="inputImage" class="hide">
                                               Выбрать изображение
                                           </label>
                                           <label title="Donload image" id="download" class="btn btn-primary">
                                               <button type="submit" class="hide"></button>
                                               Сохранить!
                                           </label>
                                           <a href="{{ url( 'dashboard/article/delete', $article['id'] ) }}" class="btn btn-warning">Удалить</a>
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

                        $('.summernote').summernote({
                            height: 300,
                        });
                        var progressBar = $('#pb');
                        $("#form").submit(function(event){
                            event.preventDefault()

                            var data = new FormData();
                            $.ajax({
                                type: 'POST',

                                url: "{{ url( "dashboard/article/edit",$article['id'])  }}",
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