<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Attached_gallery;
use Intervention\Image\ImageManager as Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

use App\Http\Requests\UplloadNewGalleryFiles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Models\gallery;
use App\Models\files;


class ControllerAdminFiles extends Controller
{
    public function index()
    {
        $data = gallery::latest('id')->get();
        return view( 'admin.files.index', compact('data'));
    }
    public function create()
    {
        return view( 'admin.files.gallery' );
    }
    public function store(UplloadNewGalleryFiles $request)
    {
        $input = $request->all();
        $gallery = new gallery();


        $title = $input['title'];

        $directoryName = parent::randomName(24);
        $disk = Storage::disk('gallery');

        if($disk->makeDirectory($directoryName))
        {
            $disk->makeDirectory("$directoryName/thumb");
            $gallery->title = $title;
            $gallery->name = $directoryName;
            $gallery->folder = "images/gallery/$directoryName";
            $gallery->created_at = Carbon::now();
            $gallery->save();
        }
            $lid = $gallery['id'];


        foreach( $input['file'] as $file )
        {
                $f = $file;
                $ext = $file->getClientOriginalExtension();

                $name = parent::randomName(24) . ".$ext";

                $thumbPath = public_path("/images/gallery/$directoryName/thumb/$name");

                $Image = new Image();
                $Image->make($f->getRealPath())->save($thumbPath, 50);
//                $Image->make($f->getRealPath())->fit(370,235)->save($thumbPath);

                $file->move( "images/gallery/$directoryName" , $name);

                $galleryFile = new files();
                $galleryFile->gallery = $lid;
                $galleryFile->name = $name;
                $galleryFile->thumb = "images/gallery/$directoryName/thumb/$name";
                $galleryFile->image = "images/gallery/$directoryName/$name";
                $galleryFile->extention = $ext;
                $galleryFile->created_at = Carbon::now();
                $galleryFile->save();




        }

    }
    public function edit($id, Request $request)
    {
    $gallery = gallery::find( $id );
    $title = $gallery['title'];
    $id = $gallery['id'];
    $files = files::where('gallery', $id)->get();

    return view('admin.files.edit', compact('files','id','gallery'));
    }
    public function update( $id, Request $request )
    {

        //dd($request->all());
        $gallery = gallery::FindOrFail( $id );
        $gallery['title'] = $request['title'];
        $gallery->save();


        $folder = $gallery['name'];
        //return $folder;
        foreach( $request['thumbs'] as $file )
        {
            $f = $file;
            $ext = $file->getClientOriginalExtension();
            $name = parent::randomName(24) . ".$ext";

            $thumbPath = public_path("images/gallery/$folder/thumb/$name");
            $Image = new Image();
            $Image->make($f->getRealPath())->save($thumbPath);
            $file->move( "images/gallery/$folder" , $name);
            $galleryFile = new files();
            $galleryFile->gallery = $id;
            $galleryFile->name = $name;
            $galleryFile->thumb = "images/gallery/$folder/thumb/$name";
            $galleryFile->image = "images/gallery/$folder/$name";
            $galleryFile->extention = $ext;
            $galleryFile->created_at = Carbon::now();
            $galleryFile->save();
        }

    }
    public function delete($id, Request $request )
    {
        $gallery = gallery::find( $id );
        $attach = Attached_gallery::where('gallery_id', $gallery['id']);
        $attach->delete();
        $title = $gallery['title'];
        $files = files::where('gallery',$id);


        $dir = $gallery['name'];
        $pic = Storage::disk('gallery');
        $pic->deleteDirectory($dir);

        $files->delete();
        $gallery->delete();
        return redirect( $_SERVER['HTTP_REFERER'] );
    }
    public function singleRemove($id)
    {
        $file  = files::FindOrFail($id);
        $folder = explode("/", $file['thumb']);
        $folderName = $folder[2];
        $fileName = $file['name'];
        if(Storage::disk("gallery")->exists("$folderName/$fileName","$folderName/thumb/$fileName"))
        {
            Storage::disk("gallery")->delete("$folderName/$fileName","$folderName/thumb/$fileName");
        }
        $file->delete();

    }

}
