@extends('admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Заявки на обучение!</h2>
            <span>смотрим, отмечаем заявки</span>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ url('dashboard/study/orders/history') }}" class="btn btn-primary btn-sm">Принятые</a>
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
                                <a href="{{ url('dashboard/study/read',$post['id'] ) }}" class="faq-question">
                                    {{ $post['name'] }}
                                </a>
                                <small><i class="fa fa-phone"></i> {{ $post['phone'] }}</small>
                            </div>
                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <a href="{{ url('dashboard/study/read',$post['id'] ) }}" class="btn btn-default dropdown-toggle"><i class="fa fa-cog"></i></a>
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

                    var Id = $(this).data('id');
                    var El = $(this).closest('.faq-item');

                    //alert(Id);

                    event.preventDefault();
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
                        processData: false,
                    });

                });


            });





                </script>

@stop
