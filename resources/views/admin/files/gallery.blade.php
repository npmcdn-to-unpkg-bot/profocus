@extends('admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Новая галерея</h2>
                <span>Здесь мы будем создавать новую галерею</span>
                <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/files/list') }}"><b>К списку галерей</b></a></span>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">


                        {!! Form::open([ 'id'=>"my-awesome-dropzone",'class'=>'dropzone dz-clickable','files'=>'true']) !!}
                        <div class="form-group"><div class="col-lg-12">
                            {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Название галереи']) !!}
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <br>
                                <button type="submit" class="btn btn-primary">Создать!</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="dropzone-previews"></div>

                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>



                        {!! Form::close() !!}


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('footer')
    <script>
        Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,
            addRemoveLinks: true,
            dictRemoveFile: 'Удалить',
            dictCancelFile: 'Удалить',
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                    toastr.success( "Галерея создана! Сейчас мы обновим страничку." );
                    $('.back-to-list').css("display","block");
                    setTimeout(function(){
                        location.reload();
                    },1500);
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                    toastr.error( "Ошибка!" );
                    $('.back-to-list').css("display","block");
                });
            }

        };

    </script>
@stop