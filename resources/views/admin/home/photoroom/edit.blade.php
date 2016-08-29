@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Обновляем информацию о фотосессии!</h2>
                    <span>Здесь мы будем обновлять фотосессии</span>
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
                                {!! Form::model($photoroom, ['id' => 'form','files'=>true, 'method' => 'POST', 'class'=> "form-horizontal"]) !!}

                                <div class="row">
                                    <div class="col-lg-9">

                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <span class="help-block m-b-none">Название</span>
                                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>


                                            <div class="hr-line-dashed"></div>

                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Укладка</span>
                                                    {!! Form::text('hair', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Мейкап</span>
                                                    {!! Form::text('makeup', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="col-sm-4">
                                                    <span class="help-block m-b-none">Фотограф</span>
                                                    {!! Form::text('photographer', null, ['class' => 'form-control']) !!}
                                                </div>
                                            </div>

                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-6">
                                                    <span class="help-block m-b-none">Дата</span>
                                                    {!! Form::text('date', null, ['class' => 'form-control datedate']) !!}

                                                </div>


                                                <div class="col-sm-6">

                                                    <span class="help-block m-b-none">Категория</span>
                                                    <select name="category" data-placeholder="Выбирете категорию..." class="form-control chosen-select">
                                                        @foreach ( $categoryCurrent as $select ):
                                                        <option selected value="{{ $select['id'] }}">{{ $select['title'] }}</option>
                                                        @endforeach;
                                                        @foreach ( $categoryAll as $item ):
                                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                                        @endforeach;
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="hr-line-dashed"></div>



                                            <div class="form-group">

                                                <div class="col-sm-6">

                                                    <span class="help-block m-b-none">Локация</span>
                                                    <select name="location" data-placeholder="Выбирете локацию..." class="form-control chosen-select">
                                                        @foreach ( $location as $select ):
                                                        <option selected value="{{ $select['title'] }}">{{ $select['title'] }}</option>
                                                        @endforeach;
                                                        @foreach ( $locations as $item ):
                                                        <option value="{{ $item['title'] }}">{{ $item['title'] }}</option>
                                                        @endforeach;
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <span class="help-block m-b-none">Галерея</span>
                                                    <select name="gallery" data-placeholder="Выбирете галерею..." class="form-control chosen-select">
                                                        @foreach ( $selected as $select ):
                                                        @if($select['id']):
                                                        <option selected value="{{ $select['id'] }}">{{ $select['title'] }}</option>
                                                        @endif
                                                        @endforeach;
                                                        @foreach ( $gallery as $item ):
                                                        <option value="{{ $item['id'] }}">{{ $item['title'] }}</option>
                                                        @endforeach;
                                                    </select>
                                                </div>
                                            </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <span class="help-block m-b-none">Текст</span>
                                                {!! Form::textarea('about', null, ['class' => 'form-control summernote']) !!}
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <div class="col-sm-12  right-side-group">
                                                <img width="100%" src="{{ url($photoroom['thumbnail']) }}" alt="">

                                                <label title="Upload image file" for="inputImageWide" class="btn btn-primary">
                                                    <input type="file" name="thumbnail" id="inputImageWide" class="hide">
                                                    376X240
                                                </label>
                                                <label title="Donload image" id="download" class="btn btn-primary">
                                                    <button type="submit" class="hide"></button>
                                                    Обновить!
                                                </label>
                                                <a href="{{ url('dashboard/photoroom/delete',$photoroom['id'] ) }}" class="btn btn-warning">Удалить фотосессию</a>
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

        $('.summernote').summernote({
            height: 300
        });

        $(document).ready(function(){
            $('.datedate').inputmask({mask: "99-99-9999"});


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
                    url: '{{ url("dashboard/photoroom/edit", $photoroom['id'] ) }}',
                    data: new FormData( this ),
                    success: function(data){
                        toastr.success( "Обновлено!" );
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

