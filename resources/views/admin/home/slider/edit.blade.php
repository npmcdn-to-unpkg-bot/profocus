@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Обновляем слайд!</h2>
                    <span>Здесь мы будем обновлять слайды</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/slider/list') }}"><b>К списку слайдов</b></a></span>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                {!! Form::model( $data, ['files'=>true, 'class'=> "form-horizontal", 'id' => 'form' ]) !!}

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
                                                {!! Form::textarea('body',null,['class'=>'form-control summernote','rows'=>'5']) !!}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="col-sm-12 right-side-group">

                                                <?php
                                                if ( $data['type'] == 'img' ) {?>
                                                    <img src="{{ url($data['path']) }}" width="100%" alt="">
                                                <?php }else { ?>
                                                    <video class="" autoplay loop muted preload="none" width="100%" height="100%">
                                                        <source src="{{ url($data['mp4']) }}" type='video/mp4' />
                                                        <source src="{{ url($data['webm']) }}" type='video/webm' />
                                                    </video>
                                                     <?php }?>

                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                    <input type="file" name="file" id="inputImage" class="hide">
                                                    Картинка / видео
                                                </label>
                                                <label title="Upload image file" for="inputImage2" class="btn btn-primary">
                                                    <input type="file" name="webm" id="inputImage2" class="hide">
                                                    WEBM Видео
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide"></button>
                                                    Обновить!
                                                </label>
                                                <a href="{{ url('dashboard/slider/delete',$data['id'] ) }}" class="btn btn-warning">Удалить слайд</a>
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
        $(document).ready(function(){

         var HelloButton = function (context) {
  var ui = $.summernote.ui;
  
  // create button
  var button = ui.button({
    contents: '<i class="fa fa-child"/> Hello',
    tooltip: 'hello',
    click: function () {
      // invoke insertText method with 'hello' on editor module.
      context.invoke('editor.insertText', 'hello');
    }
  });

  return button.render();   // return button as jquery object 
};
            $('.summernote').summernote({
                height: 300,
                lang:'pt-PT',
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['mybutton', ['hello']]
                ],
                buttons: {
                    hello: HelloButton
                }
            });


            var progressBar = $('#pb');
            $("#form").submit(function(event){
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url("dashboard/slider/edit",$data['id']) }}",
                    data: new FormData( this ),
                    success: function(url) {
                        toastr.success( "Обновлено!" );
                        $('.back-to-list').css("display","block");
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