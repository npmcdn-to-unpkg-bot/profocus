@extends('admin')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-globe text-navy mid-icon"></i>
                        </div>
                        <h2>Список партнеров</h2>
                        <span>Здесь смотрим всех партнеров!</span>
                        <a href="{{ url('dashboard/partners/new') }}">Добавить новый</a>
                    </div>
                </div>

                <div class="ibox-content forum-container">

                @foreach( $data as $partner )
                    <div class="forum-item active">
                        <div class="row">
                            <div class="col-md-11">
                                <p><a href="{{ url('dashboard/partners/edit',$partner['id'] ) }}" class="forum-item-title">{{ $partner['title'] }}</a></p>
                            </div>
                            <div class="col-md-1">
                                <a href="{{ url('dashboard/partners/delete',$partner['id'] ) }}" >Удалить</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>

@stop

