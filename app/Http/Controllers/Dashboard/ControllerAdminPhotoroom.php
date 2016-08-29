<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Attached_gallery;
use App\Models\Category;
use App\Models\Locations;
use Illuminate\Http\Request;
use App\Http\Requests\EditPhotoroomRequest;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Photoroom;
use App\Models\gallery;
use Intervention\Image\ImageManager as Image;

class ControllerAdminPhotoroom extends Controller
{
    //
    public function index()
    {
        $data = Photoroom::Latest('id')->get();
        return view('admin.home.photoroom.index', compact('data'));
    }

    public function create()
    {
        $category = Category::all();
        $gallerys = gallery::all();
        $locations = Locations::all();
        return view('admin.home.photoroom.new', compact('gallerys', 'locations','category'));
    }

    public function store( Requests\NewPhotoroomRequest $request )
    {
        $data = new Photoroom();

        $fileName = parent::randomName( 24 );
        $file = $request->file( 'thumbnail' );
        $extension =  $file->getClientOriginalExtension();
        $thumbPath = public_path( 'images/photoroom/' . "$fileName.$extension" );
        $Image = new Image();
        $Image->make( $file->getRealPath() )->fit(376,240)->save( $thumbPath, 60 );


        $data['title'] = $request['title'];
        $data['category'] = $request['category'];
        $data['gallery'] = $request['gallery'];
        $data['location'] = $request['location'];
        $data['photographer'] = $request['photo'];
        $data['date'] = $request['date'];
        $data['makeup'] = $request['makeup'];
        $data['hair'] = $request['hair'];
        $data['about'] = $request['body'];
        $data['thumbnail'] = "images/photoroom/$fileName.$extension";
        $data->save();




        



    }

    public function edit($id)
    {



        $photoroom = Photoroom::find( $id );
        $attached = Attached_gallery::where ('type_id', $id )->get();
        $a = array($photoroom['location']);
        $location = Locations::whereIn('id', $a)->get();
        $locations = Locations::whereNotIn('id', $a)->get();
//        $locations = Locations::all();

        $b = array($photoroom['category']);
        $categoryCurrent = Category::whereIn('id', $b)->get();
        $categoryAll = Category::whereNotIn('id', $b)->get();


//        $locations = Locations::all();
        $GID = array($photoroom['gallery']);
        $gallery = gallery::WhereNotIn('id',$GID)->get();
        $selected = gallery::whereIn('id',$GID)->get();
        return view( 'admin.home.photoroom.edit', compact('photoroom', 'gallery', 'selected','location','locations','categoryCurrent','categoryAll') );
    }

    public function update($id, EditPhotoroomRequest $request)
    {


        $data = Photoroom::find($id);

        $data['title'] = $request['title'];
        $data['category'] = $request['category'];
        $data['gallery'] = $request['gallery'];
        $data['location'] = $request['location'];
        $data['photographer'] = $request['photographer'];
        $data['date'] = $request['date'];
        $data['makeup'] = $request['makeup'];
        $data['hair'] = $request['hair'];
        $data['about'] = $request['about'];

        if ($request->file('thumbnail'))
        {
            $tFile = explode("/", $data['thumbnail']);
            $tDelete = $tFile[2];
            $disk = Storage::disk('images');
            if($disk->exists("category/$tDelete"))
                $disk->delete("category/$tDelete");

            $fileName = parent::randomName( 24 );
            $file = $request->file( 'thumbnail' );
            $extension =  $file->getClientOriginalExtension();
            $thumbPath = public_path( 'images/photoroom/' . "$fileName.$extension" );
            $Image = new Image();
            $Image->make( $file->getRealPath() )->fit(376,240)->save( $thumbPath, 60 );
            $data['thumbnail'] = "images/photoroom/$fileName.$extension";
        }

        $data->save();



    }

    public function remove($id)
    {
        $attached = Attached_gallery::where('type_id', $id)->first();

        $data = Photoroom::find($id);
        $disk = Storage::disk('images');
        $folder = "photoroom";


        $tFile = explode("/", $data['thumbnail']);
        $tDelete = $tFile[2];

        if($disk->exists("$folder/$tDelete"))
            $disk->delete("$folder/$tDelete");


        $data->delete();
        $attached->delete();
        return redirect(url('dashboard/photoroom/list'));
    }


}
