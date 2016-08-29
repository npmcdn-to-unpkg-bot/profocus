@extends('admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <h2>Добро пожаловать!</h2>
            <span>Административная панель, здесь можно все!</span>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">




                @foreach( $pages as $post )
                    <?php
                    if( $post['enable'] == 'no' )
                    {
                        $active = 'deactive';
                        $icon = 'fa-file-o';
                    }
                    else
                    {
                        $active = '';
                        $icon = 'fa-file';
                    }
                    ?>
                    <div class="faq-item">
                        <div class="row">
                            <div class="col-md-10">
                                <a href="{{ url('dashboard/pages/edit',$post['id'] ) }}" class="faq-question <?= $active; ?>">
                                    {{ $post['title'] }}
                                </a>
                                <small>Редактируемая страница сайта</small>
                            </div>

                            <div class="col-md-2 text-right">
                                <div class="btn-group">
                                    <a href="{{ url('dashboard/pages/off',$post['id']) }}"  class="btn btn-default status"><i class="fa fa-power-off"></i></a>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>



@stop
@section('footer')
    <script>

    </script>
@stop

