@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Новая модель!</h2>
                    <span>Здесь мы будем добавлять моделей</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/models/list') }}"><b>К списку курсов</b></a></span>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">
                                {!! Form::open(['id' => 'form','url'=>'dashboard/models/new','files'=>true, 'method' => 'POST', 'class'=> "form-horizontal"]) !!}

                                <div class="row">
                                    <div class="col-lg-9">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <span class="help-block m-b-none">Имя</span>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Бюст</span>
                                                    <input type="text" name="bust" placeholder="90"  class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Талия</span>
                                                    <input type="text" name="waist" placeholder="60"  class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Бедра</span>
                                                    <input type="text" name="hips" placeholder="90" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Размер платья</span>
                                                    <input type="text" name="dress" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Размер обуви</span>
                                                    <input type="text" name="shoe" class="form-control">
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Цвет волос</span>
                                                    <input type="text" name="hair" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="help-block m-b-none">Цвет глаз</span>
                                                    <input type="text" name="eye" class="form-control">
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="help-block m-b-none">Рост</span>
                                                    <input type="text" name="stature" class="form-control">
                                                </div>
                                                <div class="col-sm-12">
                                                    <span class="help-block m-b-none">Галерея</span>
                                                    <select name="gallery[]" data-placeholder="Выбирете галерею..." class="form-control chosen-select" multiple="">
                                                        @foreach( $gallerys as $gallery )
                                                            <option value="{{ $gallery['id'] }}">{{ $gallery['title'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Текст</span>
                                                <textarea type="text" name="body" class="form-control summernote" rows="5"></textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-3">

                                        <div class="form-group">
                                            <div class="col-sm-12 right-side-group">

                                                <br>
                                                
                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                    <input type="file" name="thumbnailWide" id="inputImage" class="hide">
                                                    1920х600
                                                </label>
                                                <label title="Upload image file" for="inputImageWide" class="btn btn-primary">
                                                    <input type="file" name="thumbnail" id="inputImageWide" class="hide">
                                                    Аватар
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide"></button>
                                                    Готово!
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



                    $(document).ready(function(){
                        $('.summernote').summernote({
                            height: 300

                        });
                        var config = {
                            '.chosen-select'           : {},
                            '.chosen-select-deselect'  : {allow_single_deselect:true},
                            '.chosen-select-no-single' : {disable_search_threshold:10},
                            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
                            '.chosen-select-width'     : {width:"95%"}
                        };
                        for (var selector in config) {
                            $(selector).chosen(config[selector]);
                        }


                        var progressBar = $('#pb');
                        $("#form").submit(function(event){
                            event.preventDefault();

                            var data = new FormData();
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('dashboard/models/new') }}",
                                data: new FormData( this ),
                                success: function(data){
                                    toastr.success( "Добавлено!" );
                                    $('.back-to-list').css("display","block");
                                    window.location = "/dashboard/models/list";
                                    
                                    
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
                                cache: false
                            });

                        });
                    });
                </script>
@stop

