@extends('admin')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Обновляем галерею!</h2>
                    <span>Что бы удалить изображени нужно на него нажать</span>
                    <span class="back-to-list" style="display: none;"><a href="{{ url('dashboard/files/list') }}"><b>К списку галерей</b></a></span>

                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">


                            {!! Form::model($gallery,['id'=>"my-awesome-dropzone",'class'=>'dropzone dz-clickable','files'=>'true']) !!}
                            <div class="form-group"><div class="col-lg-12">
                                    {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'Название галереи']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Обновить!</button>
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

                    <div class="col-lg-12">
                        <div class="ibox-content">
                            <div class="lightBoxG1allery isotop">
                                @foreach( $files as $file )
                                        <img width="100" style="padding: 1px;" class="delete ggg" data-id="{{ $file['id'] }}" src="{{ url($file['thumb']) }}" alt="">
                                @endforeach


                            </div>

                        </div>
                        <div class="ibox float-e-margins">

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

            autoDiscover: false,
            addRemoveLinks: true,
            paramName: "thumbs",
            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            url: "{{ url('dashboard/files/edit',$gallery['id']) }}",
            maxFiles: 100,
            maxFilesize: 5,
            dictDefaultMessage: "Drag or click to add photos",

            // The setting up of the dropzone
            init: function () {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("button[type=submit]").addEventListener("click", function (e, formData) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    }
                    else
                    {
                        toastr.success( "Обновлено!" );
                        $('.back-to-list').css("display","block");
                        myDropzone.uploadFiles([]);

                    }
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function (file, xhr, formData) {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                    formData.append('title', $("input[name=title]").val());
                    formData.append('desc', $("textarea[name=description]").val());

                });
                this.on("successmultiple", function (files, response) {
                    toastr.success( "Обновлено!" );
                    $('.back-to-list').css("display","block");
                });
                this.on("errormultiple", function (files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }
        $(document).ready(function() {

            var $container = $('.isotop');

            $container.imagesLoaded(function(){
                $container.masonry({
                    itemSelector: '.ggg',
                    columnWidth: '.ggg'
                });
            });
            $(".delete").on('click',function(){
                self = $(this);
                id = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('dashboard/files/singleRemove') }}/"+id,
                    success: function(data){
                        console.log('success');
                        self.remove();
                        toastr.success( "Файл удален!" );
                        $('.back-to-list').css("display","block");
                        var $container = $('.isotop');

                        $container.imagesLoaded(function(){
                            $container.masonry({
                                itemSelector: '.ggg',
                                columnWidth: '.ggg'
                            });
                        });
                    },
                    error: function (data) {
                        toastr.error( "Файл не удален! Что - то пошло не так, сейчас мы перезагрум страничку и вы попробуете снова" );
                        setTimeout(function(){
                            location.reload();
                        },2000);
                        $('.back-to-list').css("display","block");
                    },
                    beforeSend: function (xhr) {
                        var token = $('meta[name="csrf_token"]').attr('content');

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    }
                });
            })
        });

                </script>

@stop