<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\course;
use App\Http\Requests\NewStudyRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Http\Requests\NewCourseRequest;
use App\Http\Requests\EditCourseRequest;
class ControllerAdminStudy extends Controller
{
    //
    public function index()
    {
       $data = course::Latest('id')->get();
       return view( 'admin.study.index', compact('data') );
    }

    public function create()
    {
        return view( 'admin.study.create' );
    }

    public function store(NewCourseRequest $request)
    {
        $data = new course();
        $data['title'] = $request['title'];
        $data['about'] = $request['body'];
        $data['price'] = $request['price'];

        $fileName = parent::randomName( 24 );
        $file = $request->file( 'thumbnail' );
        $extension =  $file->getClientOriginalExtension();
        $thumbPath = public_path( 'images/study/course/' . "$fileName.$extension" );

        $Image = new Image();
        $Image->make( $file->getRealPath() )->fit(376,240)->save( $thumbPath, 60 );

        $data['thumbnail'] = "images/study/course/$fileName.$extension";
        $data->save();

    }

    public function edit($id)
    {
        $data = course::FindOrFail($id);
        return view( 'admin.study.edit', compact('data') );
    }

    public function update($id, EditCourseRequest $request)
    {
        $data = course::FindOrFail($id);
        $data['title'] = $request['title'];
        $data['about'] = $request['about'];
        $data['price'] = $request['price'];

        if( $request->file('thumbnail') )
        {
            $tFile = explode("/", $data['thumbnail']);
            $tDelete = $tFile[3];
            $disk = Storage::disk('images');
            if($disk->exists("study/course/$tDelete"))
                $disk->delete("study/course/$tDelete");

            $fileName = parent::randomName( 24 );
            $file = $request->file( 'thumbnail' );
            $extension =  $file->getClientOriginalExtension();
            $thumbPath = public_path( 'images/study/course/' . "$fileName.$extension" );

            $Image = new Image();
            $Image->make( $file->getRealPath() )->fit(376,240)->save( $thumbPath, 60 );
            $data['thumbnail'] = "images/study/course/$fileName.$extension";
        }

        $data->save();
    }

    public function remove($id)
    {

        $data = course::FindOrFail($id);
        $disk = Storage::disk('images');
        $folder = "study/course";


        $tFile = explode("/", $data['thumbnail']);
        $tDelete = $tFile[3];

        if($disk->exists("$folder/$tDelete"))
            $disk->delete("$folder/$tDelete");


        $data->delete();
        return redirect(url('dashboard/study/list'));
    }
    
    
}
