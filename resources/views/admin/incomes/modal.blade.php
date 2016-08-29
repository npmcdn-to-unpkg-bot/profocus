<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div id="preloader"><div class="textload">Загрузка</div><div id="status"><div class="spinner"></div></div></div>
        <div class="modal-content">
            {!! Form::model( $page[0], ['url'=>'dashboard/pages/edit/1','files'=>true, 'class'=> "form-horizontal", 'id' => 'form' ]) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Настройки главной страницы</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <span class="help-block m-b-none">Заголовок</span>
                                {{--{!! Form::text('title',null,['class'=>'form-control']) !!}--}}
                                <input type="text" name="title" class="form-control page-title" >
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">

                                <?php
                                if( $page[0]['enable'] == "yes" )
                                {
                                    $active = "checked=''";
                                    $disable = '';
                                }
                                else
                                {
                                    $active = '';
                                    $disable = "checked=''";
                                }
                                ?>

                                <div class="radio radio-success radio-inline">
                                    <input type="radio" id="inlineRadio1" value="yes" name="enable" {!! $active !!} >
                                    <label for="inlineRadio1"> Страница включена </label>
                                </div>


                                <div class="radio radio-inline">
                                    <input type="radio" id="inlineRadio2" value="no" name="enable" {!! $disable !!}>
                                    <label for="inlineRadio2"> Страница отключена </label>
                                </div>


                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9">
                                <span class="help-block m-b-none">Текст</span>
                                {{--{!! Form::textarea('body',null,['class'=>'summernote form-control summernote']) !!}--}}
                                <textarea name="body" class="summernote form-control page-body"></textarea>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="col-sm-12 right-side-group">

                                        <label title="Upload image file" for="inputImage" class="btn btn-primary">
                                            <input type="file" name="file" id="inputImage" class="hide">
                                            Картинка
                                        </label>
                                        <label title="Donload image" id="download" class="btn btn-primary">
                                            <button type="submit" class="hide"></button>
                                            Обновить
                                        </label>
                                        <div class="progress">
                                            <div id="pb" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-default"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label title="Donload image" id="download" class="btn btn-primary">
                    <button type="submit" class="hide"></button>
                    Обновить!
                </label>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>