@extends('admin')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Слайды</h2>
            <span>смотрим, обновляем, удаляем слайды</span>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ url('dashboard/slider/new') }}" class="btn btn-primary btn-sm">Добавить</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">




                @foreach( $data as $slide )

                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ url('dashboard/slider/edit',$slide['id'] ) }}" class="faq-question">
                                    @if( $slide['type'] == 'img' )
                                        <i class="fa fa-image"></i>
                                    @else
                                        <i class="fa fa-video-camera"></i>
                                    @endif    {{ $slide['title'] }}
                                </a>

                                <small><i class="fa fa-clock-o"></i> {{ $slide['created_at'] }}</small>
                            </div>

                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                    <ul class="dropdown-menu" style="right: 0 !important;">
                                        <li><a href="{{ url('dashboard/slider/edit',$slide['id'] ) }}"  class="editArticle" >Редактировать</a></li>
                                        <li><a href="#" data-id="{{ $slide['id'] }}" class="deleteArticle">Удалить</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>



@stop
@section('footer')

    <script>


        $(document).ready(function() {

            $('.deleteArticle').on("click", function(event){
                event.preventDefault();
                var Id = $(this).data('id');
                var El = $(this).closest('.faq-item');
                $.ajax({
                    type: 'GET',
                    url: "{{ url('dashboard/slider/delete') }}/" + Id,
                    success: function(data){
                        toastr.success( "Удалено!" );
                        El.remove();
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
                    processData: false
                });

            });


        });





    </script>

@stop