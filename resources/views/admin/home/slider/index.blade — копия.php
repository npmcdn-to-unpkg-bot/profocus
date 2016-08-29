@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Новий слайдер!</h2>
                    <span>Здесь мы будем добавлять слайды</span>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">



                <div class="row">




                                <span class="help-block m-b-none">Заголовок</span>
                                <input type="text" name="title" class="form-control">
                    <br>

                                <textarea type="text" name="body" class="form-control summernote" rows="5"></textarea>


                                Картинка / видео
                                <input type="file" name="file" id="inputImage" class="button hid1e">

                                <br><br>


                                    WEBM Видео
                                <input type="file" name="webm" id="inputImage2" class="button hid1e">
                                <br><br>


                                    <button type="submit" class="h1ide button">Готово, добавляем слайд!</button>



                                <div class="progress" >
                                    <div id="pb" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-default"></div>
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

                        $('.summernote').summernote({
                            height: 300,
                            toolbar: [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']]
                            ]
                        });

                        var progressBar = $('#pb');
                        $("#form").submit(function(){
                            event.preventDefault()
                            var data = new FormData();
                            $.ajax({
                                type: 'POST',
                                url: 'new',
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
                                    window.location = "/dashboard/slider/list";

                                },
                                error: function (data) {
                                    swal({
                                        type: "error",
                                        title: "Oops! Ошибка",
                                        text: data.responseJSON.file + " Если ошибка не исчезает - пиши Андрею, он ждет :)",
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
                                            if ( percentComplete != 100 )
                                            {
                                                progressBar.text('Загрузка, ожидайте! Это может занять несколько минут!');
                                            }
                                            else
                                            {
                                                progressBar.text('');
                                            }
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