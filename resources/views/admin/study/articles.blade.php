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
                        <h2>Список постов!</h2>
                        <span>Ну нифига себе!</span>
                        <a href="{{ url('dashboard/article/new') }}">Добавить новый</a>
                    </div>
                </div>


                <div class="ibox-content forum-container">
                    @foreach( $data as $post )
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="forum-icon">
                                            <i class="fa fa-file-o"></i>
                                    </div>
                                    <a href="{{ url('dashboard/article/edit',$post['id'] ) }}" class="forum-item-title">{{ str_limit($post['title'],35) }}</a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url('dashboard/article/delete',$post['id'] ) }}" >Удалить</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>






@stop

