@extends('admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Материал</h2>
            <span>Дополнительный текст на некоторых страницах</span>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">




                @foreach( $stuff as $post )

                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ url('dashboard/stuff/edit',$post['id'] ) }}" class="faq-question">
                                    {{ $post['title'] }}
                                </a>
                                <small>Редактируемый материал</small>
                            </div>

                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <a href="{{ url('dashboard/stuff/edit',$post['id'] ) }} " class="btn btn-default" aria-expanded="false"><i class="fa fa-cog"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>




@stop

