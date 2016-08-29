<?php


namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Requests\NewSliderRequest;
use App\Http\Requests\EditSliderRequest;
use App\Models\Slider;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ControllerAdminSlider extends Controller
{
    public function index()
    {
        return view('admin.home.slider.index');
    }

    public function uploadFiles(NewSliderRequest $request)
    {
        $slider = new Slider();
        $slider->title = $request['title'];
        $slider->body = $request['body'];

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();

        $name = parent::randomName(24);

        if( $extension == 'jpg' or $extension == 'png' )
        {
            $file->move( "images/", "$name.$extension" );

            $slider->type = "img";
            $slider->path = "images/$name.$extension";
        }
        else
        {
            $webm = $request->file('webm');
            $webmExtension = $webm->getClientOriginalExtension();

            $path = public_path() . "/video/";

            $webm->move( $path, "$name.$webmExtension" );
            $file->move( $path, "/$name.$extension" );

            $slider->type = "video";
            $slider->cover = "images/cover.png";
            $slider->webm = "video/$name.$webmExtension";
            $slider->mp4 = "video/$name.$extension";
        }

        $slider->save();
    }

    public function slides()
    {
        $data = slider::latest('id')->get();
        return view('admin.home.slider.slides', compact('data') );
    }

    public  function edit( $id )
    {
        $data = slider::FindOrFail( $id );
        return view('admin.home.slider.edit', compact('data') );
    }

    public function update( $id, EditSliderRequest $request )
    {
        $slider = slider::FindOrFail($id);
        $slider->title = $request['title'];
        $slider->body = $request['body'];

        if ( $request['file'] )
        {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $name = parent::randomName(24);

            $storage = Storage::disk('images');

            if ( $extension == 'jpg' or $extension  == 'png')
            {
                // Удаляем прошлый файл
                if ( !empty( $slider['mp4'] ) && !empty( $slider['webm'] ) )
                {
                    $deleteMp4 = explode( "/", $slider['mp4'] );
                    $deleteWebm = explode( "/", $slider['webm'] );
                    $diskVideo = Storage::disk('video')->delete( $deleteMp4[1],$deleteWebm[1] );
                }
                else
                {
                    $delete = explode( "/", $slider['path'] );
                    $diskImage = Storage::disk('image')->delete( $delete[1] );
                }
                $slider->path = "images/$name.$extension";
                $slider->webm = null;
                $slider->mp4 = null;
                $slider->cover = null;

                $file->move("images/", "$name.$extension");
                $slider->type = 'img';
            }
            else
            {
                // Удаляем прошлые файлы
                if ( !empty( $slider['mp4'] ) && !empty( $slider['webm'] ) )
                {
                    $deleteMp4 = explode( "/", $slider['mp4'] );
                    $deleteWebm = explode( "/", $slider['webm'] );
                    $diskVideo = Storage::disk('video')->delete( $deleteMp4[1],$deleteWebm[1] );

                }
                $file = $request->file( 'file' );
                $extension = $file->getClientOriginalExtension();

                $webm = $request->file( 'webm' );
                $webmExtension = $webm->getClientOriginalExtension();

                $file->move( "video/", "$name.$extension" );
                $webm->move( "video/", "$name.$webmExtension" );

                $slider->type = 'video';
                $slider->webm = "video/$name.webm";
                $slider->mp4 = "video/$name.mp4";
                $slider->cover = "/images/cover.png";
            }
        }
        $slider->save();
    }

    public function delete( $id,  Request $request )
    {
        $slider = slider::FindOrFail( $request->id );
        if ( !empty( $slider['mp4'] ) && !empty( $slider['webm'] ) )
        {
            $deleteMp4 = explode( "/", $slider['mp4'] );
            $deleteWebm = explode( "/", $slider['webm'] );
            if ( Storage::disk('video')->exists($deleteMp4[1],$deleteWebm[1]))
                 Storage::disk('video')->delete( $deleteMp4[1],$deleteWebm[1] );
        }
        else
        {
            $delete = explode("/", $slider['path']);
            if ( Storage::disk('images')->exists($delete[1]))
                 Storage::disk('images')->delete($delete[1]);
        }
        $slider->delete();
        return redirect( "dashboard/slider/list" );
    }
}
