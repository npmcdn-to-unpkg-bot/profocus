@extends('admin')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="ibox-content m-b-sm border-bottom">
                    <div class="p-xs">
                        <div class="pull-left m-r-md">
                            <i class="fa fa-home text-navy mid-icon"></i>
                        </div>
                        <h2>Галереи!</h2>
                        <span>Список галерей</span>
                    </div>
                </div>

                <div class="ibox-content forum-container">



                    @foreach( $gallerys as $gallery )
                        <div class="forum-item">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="forum-icon">
                                        <i class="fa fa-image"></i>
                                    </div>
                                    <a href="{{ url('dashboard/files/edit',$gallery['id']) }}" class="forum-item-title">{{ $gallery['title'] }}</a>
                                    <div class="forum-sub-title">Галерея была создана {{ $gallery['created_at'] }}</div>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url('dashboard/files/delete',$gallery['id'] ) }}" >Удалить</a>
                                </div>
                            </div>
                        </div>
                    @endforeach








                </div>
            </div>
        </div>
    </div>

@stop

