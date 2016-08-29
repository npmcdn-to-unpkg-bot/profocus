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
                        <h2>Список скидок</h2>
                        <span>Ну нифига себе | <a href="{{ url("dashboard/discount/new") }}">Добавить скидку</a> </span>
                    </div>
                </div>

                <div class="ibox-content forum-container">


                    @foreach( $data as $deduction )
                        <div class="forum-item active">
                            <div class="row">
                                <div class="col-md-11">
                                    <div class="forum-icon">
                                            <i class="fa fa-money"></i>
                                    </div>
                                    <a href="{{ url('dashboard/discount/edit',$deduction['id'] ) }}" class="forum-item-title">{{ $deduction['title'] }}</a>
                                    <div class="forum-sub-title">Размер скидки - {{ $deduction['discount'] }}%. Действие скидки {{ $deduction['start_date'] }}@if( $deduction['end_date'] != "0000-00-00" ) - {{ $deduction['end_date'] }}@endif</div>
                                </div>
                                <div class="col-lg-1">
                                    <a href="{{ url('dashboard/discount/delete',$deduction['id'] ) }}" class="delete">Удалить</a>
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>



@stop



