@extends('admin')


@section('content')

    <div class="row">
        <div class="col-lg-12">


            <div class="wrapper wrapper-content animated fadeInRight">
                <p> <b><a href="#" class="page-setting" data-toggle="modal" data-target=".bs-example-modal-lg" data-page="{{ $page[0]['id'] }}" >Настройка</a></b></p>
                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-globe text-navy mid-icon"></i>
                        </div>
                        <h2>Аренда студии! {{ $getting }}</h2>
                        <span>Локации, заказы, оборудование</span>
                    </div>
                </div>
                </div>



                <div class="wrapper wrapper-content animated fadeInRight">
                <div class="ibox-content forum-container">
                    <div class="forum-title">
                        <h3>Работа с лоакциями!</h3>
                    </div>

                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/location/new') }}" class="forum-item-title">Добавить</a>
                                <div class="forum-sub-title">Здесь мы добавляем лоакции.</div>
                            </div>
                        </div>
                    </div>
                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/location/list') }}" class="forum-item-title">Обновить или удалить</a>
                                <div class="forum-sub-title">Здесь мы обновляем и удаляем лоакции.</div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>



                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content forum-container">

                    <div class="forum-title">
                        <h3>Онлайн заказы</h3>
                    </div>

                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/orders/list') }}" class="forum-item-title">Заказы</a>
                                <div class="forum-sub-title">Здесь мы смотрим новые заказы.</div>
                            </div>
                        </div>
                    </div>
                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/orders/discount') }}" class="forum-item-title">Добавит, изменить или удалить скидки</a>
                                <div class="forum-sub-title">Здесь мы работаем со скидками в онлайн бронировании.</div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>


                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content forum-container">

                    <div class="forum-title">
                        <h3>Оборудование</h3>
                    </div>

                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/equipment/new') }}" class="forum-item-title">Добавить</a>
                                <div class="forum-sub-title">Здесь мы новое оборудование.</div>
                            </div>
                        </div>
                    </div>
                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/equipment/list') }}" class="forum-item-title">Изменить или удалить</a>
                                <div class="forum-sub-title">Здесь мы редактируем оборудование!</div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>





                </div>
            </div>
        </div>
    </div>



@stop


@section('footer')

    {{--MODAL--}}

    @include( 'admin.incomes.modal' )

    {{--MODAL--}}

@stop