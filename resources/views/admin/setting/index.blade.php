@extends('admin')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Настройки!</h2>
                    <span>Здесь мы будем, что - то настраивать!</span>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                {!! Form::open(['url'=>'dashboard/setting/update','files'=>'true','id' => 'form', 'method' => 'POST', 'class'=> "form-horizontal" ]) !!}
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p>Адрес</p>
                                        <input type="text" value="{{$setting['city']}}" name="city" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p>Номер телефона, можно указать несколько через запятую</p>
                                        <input type="text" value="{{$setting['phone']}}" name="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p>Адрес электронной почты, можно указать несколько через запятую</p>
                                        <input type="text" value="{{$setting['email']}}" name="email" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <p>Цена по умолчанию для аренды фотостудии</p>
                                        <input type="text" value="{{$setting['price']}}" name="price" class="form-control">
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
            $("#form").submit(function(event){
                event.preventDefault();
                var data = new FormData();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('dashboard/setting/update') }}",
                    data: new FormData( this ),
                    success: function(url) {
                        toastr.success( "Обновление!" );
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
                    contentType: false,
                    processData: false,
                });
            });
        });
    </script>

@stop