@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Новая фотосессия!</h2>
                    <span>Здесь мы будем добавлять фотосесси</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/photoroom/list') }}"><b>К списку фотосессий</b></a></span>

                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">

                            <div class="ibox-content">

                                {!! Form::open(['url'=>'dashboard/location/new','files'=>'true', 'method' => 'POST', 'class'=> "form-horizontal", 'id' => 'form' ]) !!}


                                <div class="row">
                                    <div class="col-lg-9">

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Название</span>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                        </div>

 <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                <span class="help-block m-b-none">Укладка</span>
                                                <input type="text" name="hair" class="form-control">
                                            </div>
                                                <div class="col-sm-4">
                                                <span class="help-block m-b-none">Мейкап</span>
                                                <input type="text" name="makeup" class="form-control">
                                            </div>
                                            <div class="col-sm-4">
                                                <span class="help-block m-b-none">Фотограф</span>
                                                <input type="text" name="photo" class="form-control">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-6">
                                                <span class="help-block m-b-none">Дата</span>
                                                <input type="text"  name="date" class="form-control datedate">
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="help-block m-b-none">Категория</span>
                                                <select name="category" data-placeholder="Выбирете категорию..." class="form-control chosen-select">
                                                    @foreach( $category as $data )
                                                        <option value="{{ $data['id'] }}">{{ $data['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                         <div class="col-sm-6">
                                                <span class="help-block m-b-none">Локация</span>
                                                <select name="location" data-placeholder="Выбирете локацию..." class="form-control chosen-select">
                                                    @foreach( $locations as $data )
                                                        <option value="{{ $data['title'] }}">{{ $data['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <span class="help-block m-b-none">Галерея</span>
                                                <select name="gallery" data-placeholder="Выбирете галерею..." class="form-control chosen-select">
                                                    @foreach( $gallerys as $gallery )
                                                        <option value="{{ $gallery['id'] }}">{{ $gallery['title'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">О локации</span>
                                                <textarea type="text" name="body" class="form-control summernote body" rows="5"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-3">

                                        <div class="form-group">
                                            <div class="col-sm-12  right-side-group">
                                                <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                                    {{ Form::file('files',['name'=>'thumbnail', 'id'=>'inputImage','class'=>'hide','multiple'=>'true' ]) }}
                                                    376X240
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide" ></button>
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
                    $(document).ready(function(){
                        $('.datedate').inputmask({mask: "99-99-9999"});
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
                                url: 'new',
                                data: new FormData( this ),
                                success: function(url) {
                                    toastr.success( "Добавлено!" );
                                    $('.back-to-list').css("display","block");
                                    $('#form').trigger('reset')
                                    $('.summernote').summernote('code', '')
                                    $('#pb').css( "width", "0%" ).attr('aria-valuemax', 0);
                                    $('#pb').text("");
                                    /*setTimeout(function(){
                                        location.reload();
                                    },1000);*/
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
