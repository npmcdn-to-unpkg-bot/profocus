@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Информация о заказе!</h2>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/study/orders/list') }}"><b>К списку категорий</b></a></span>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12 animated fadeInRight">
                        <div class="mail-box-header">
                            <div class="pull-right tooltip-demo">
                                <a href="#" class="btn btn-white btn-sm accept" data-id="{{ $data['id'] }}" data-toggle="tooltip" data-placement="top" title="Принять"><i class="fa fa-thumbs-o-up"></i> </a>
                                <a href="#" class="btn btn-white btn-sm delete" data-toggle="tooltip" data-placement="top" title="Отклонить"><i class="fa fa-trash-o"></i> </a>
                            </div>
                            <div class="mail-tools tooltip-demo m-t-md">


                                <h3>
                                    <span class="font-noraml">Курс: </span>{{ $course['title'] }}
                                </h3>
                                <h5>
                                    <span class="pull-right font-noraml">Дата заявки: {{ $data['created_at'] }}</span>
                                    <p><span class="font-noraml"><i class="fa fa-envelope-o"></i> </span>{{ $data['email'] }}</p>
                                    <p><span class="font-noraml"><i class="fa fa-phone"></i> </span>{{ $data['phone'] }}</p>
                                </h5>
                            </div>
                        </div>
                        <div class="mail-box">


                            <div class="mail-body">
                                {!! $data['note'] !!}
                            </div>

                            <div class="clearfix"></div>


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



                        $(".accept").on("click",function(event){
                            event.preventDefault(event);



                            var ob = { "Approved":"yes" };
                            $.ajax({
                                type: 'POST',
                                url: "{{ url( "dashboard/study/singleApprove",$data['id'])  }}",
                                data: ob,
                                success: function(data){
                                    toastr.success( "Заявка принята!" );
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
                                }
                            });

                        });


                        $(".delete").on("click",function(event){
                            event.preventDefault(event);



                            var ob = { "Approved":"no" };
                            $.ajax({
                                type: 'POST',
                                url: "{{ url( "dashboard/study/singleApprove",$data['id'])  }}",
                                data: ob,
                                success: function(data){
                                    toastr.success( "Удалено!" );
                                    setTimeout(function(){
                                        window.location = "/dashboard/study/orders/list";
                                    },1000);

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
                                }
                            });

                        });



                    });


                </script>

@stop