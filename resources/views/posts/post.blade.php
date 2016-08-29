@extends('template')

@section('title')
    Пост: {{ $news['title'] }}
@stop

@section('content')
    <?
    if( request()->route()->getName() != 'home' )
    {
        echo '<div class="offset" style="padding-top: 90px;"></div>';
    }
    ?>
<div class="dark-wrapper">
    <div class="container inner2">
        <div class="col-sm-12 blog-content">
            <div class="blog-posts classic-view">
                <div class="post">
                    <div class="box text-center">

                        <h1 class="post-title" style="text-align: left !important;">
                            {{ $news['title']  }}
                        </h1>
                        <div class="post-content text-left">
                        {!! $news['body'] !!}
                        </div>
                        <!-- /.post-content -->

                    </div>
                    <!-- /.box -->

                </div>
                <!-- .post -->

                <div class="box">
                            <strong>Дата публикации: </strong><span class="date">{{ $news['date']  }}</span>
                </div>
                <!-- /.box -->




            </div>
            <!-- /.classic-view -->

        </div>
    </div>
</div>

@stop