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
                        <h2>Список страниц</h2>
                        <span>Ну нифига себе!</span>
                    </div>
                </div>

                <div class="ibox-content forum-container">


                    @foreach( $data as $slide )
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="forum-icon">

                                            <i class="fa fa-file-text-o"></i>

                                    </div>
                                    <a href="{{ url('dashboard/pages/edit',$slide['id'] ) }}" class="forum-item-title">{{ $slide['title'] }}</a>
                                    <div class="forum-sub-title">{!! str_limit($slide['body'],100) !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>



@stop



