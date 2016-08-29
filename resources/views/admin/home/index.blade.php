@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">
                <p> <b><a href="#" class="page-setting" data-toggle="modal" data-target=".bs-example-modal-lg" data-page="{{ $page[0]['id'] }}" >Настройка</a></b></p>

                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-home text-navy mid-icon"></i>
                        </div>
                        <h2>Главная страница! {{ $getting }}</h2>
                        <span>Слайдер, новости</span>
                    </div>
                </div>

                </div>
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="ibox-content forum-container">

                    {{--<div class="forum-title">--}}
                        {{--<h3>Работа со слайдером!</h3>--}}
                    {{--</div>--}}

                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/slider/list') }}" class="forum-item-title">Слайды</a>
                                <div class="forum-sub-title">Здесь мы добавляем слайды.</div>
                            </div>
                        </div>
                    </div>

                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/category/list') }}" class="forum-item-title">Категории</a>
                                <div class="forum-sub-title">Здесь мы добавляем категории.</div>
                            </div>
                        </div>
                    </div>
                    <div class="forum-item">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="forum-icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="{{ url('dashboard/photoroom/list') }}" class="forum-item-title">Фотосессии</a>
                                <div class="forum-sub-title">Здесь мы добавляем фотосессии.</div>
                            </div>
                        </div>
                    </div>

                    </div>
                    </div>
                <
        </div>
    </div>

@stop
@section('footer')

    {{--MODAL--}}

    @include( 'admin.incomes.modal' )

    {{--MODAL--}}

@stop
