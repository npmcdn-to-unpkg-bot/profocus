@extends('admin')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Заказы</h2>
            <span>Полная информация о казазах</span>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">




                @foreach( $data1 as $post )

                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ url( 'dashboard/orders', $post['id'] ) }}" class="faq-question">
                                    {{ $post['name'] }}
                                </a>
                                <span>Мобильный телефон: <b>{{ $post['phone'] }}</b> | Электронный адрес <b>{{ $post['email'] }}</b></span>
                            </div>

                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" aria-expanded="false"><i class="fa fa-cog"></i></button>
                                    <ul class="dropdown-menu" style="right: 0 !important;">
                                        <li><a href="{{ url('dashboard/category/edit',$post['id'] ) }}"  class="editArticle" >Редактировать</a></li>
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


