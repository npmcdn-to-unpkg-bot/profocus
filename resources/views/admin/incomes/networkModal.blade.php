<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog" role="document">
        <div id="preloader"><div class="textload">Загрузка</div><div id="status"><div class="spinner"></div></div></div>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="form">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <span class="help-block m-b-none">Ссылка</span>
                                {{--{!! Form::text('title',null,['class'=>'form-control']) !!}--}}
                                <input type="text" name="href" class="form-control input-network" >
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <label title="Donload image" id="download" class="btn btn-primary">
                    <button type="submit" id="sendForm" class="hide"></button>
                    Обновить!
                </label>
            </div>
            </form>
        </div>
    </div>
</div>