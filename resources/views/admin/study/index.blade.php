@extends('admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Курсы</h2>
            <span>смотрим, обновляем, удаляем курсы</span>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ url('dashboard/study/new') }}" class="btn btn-primary btn-sm">Добавить</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">




                @foreach( $data as $post )

                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ url('dashboard/study/edit',$post['id'] ) }}" class="faq-question">
                                    {{ $post['title'] }}
                                </a>
                                <?php
                                if( $post['updated_at'] != NULL ){
                                ?>
                                <small><i class="fa fa-clock-o"></i> {{ $post['updated_at'] }}</small>
                                <?php }
                                else{
                                ?>
                                <small><i class="fa fa-clock-o"></i> {{ $post['created_at'] }}</small>
                                <?php }?>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                    <ul class="dropdown-menu" style="right: 0 !important;">
                                        <li><a href="{{ url('dashboard/study/edit',$post['id'] ) }}"  class="editArticle" >Редактировать</a></li>
                                        <li><a href="#" data-id="{{ $post['id'] }}" class="deleteArticle">Удалить</a></li>
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
                        url: "{{ url('dashboard/study/delete') }}/" + Id,
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
