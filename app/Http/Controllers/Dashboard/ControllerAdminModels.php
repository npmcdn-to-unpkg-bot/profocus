<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Models;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\gallery;
use App\Models\Pages;
use App\Models\Attached_gallery;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Http\Requests\newModel;
use App\Http\Requests\editModel;
class ControllerAdminModels extends Controller
{
    //
    public function index()
    {
        $getting = parent::getting();
        $models = Models::latest('id')->paginate(12);
        $page = Pages::Where( "page", "models" )->get();
        return view('admin.models.index', compact('page', 'getting', 'models') );
    }
    

    public function create()
    {
        $gallerys = gallery::all();


        return view('admin.models.new', compact('gallerys'));
    }
    public function store( newModel $request )
    {
        $model = new Models();

        $storage = Storage::disk('models');
        if( $request['thumbnail'] && $request['thumbnailWide'] )
        {
            $thumbnail = $request['thumbnail'];
            $extension = $request['thumbnail']->getClientOriginalExtension();

            $thumbnailWide = $request['thumbnailWide'];
            $extensionWide = $request['thumbnailWide']->getClientOriginalExtension();

                $thumb = "thumb-".parent::randomName(24).".".$extension;
                $wide = "wide-".parent::randomName(24).".".$extensionWide;
                $thumbDirectory = public_path("/images/models/$thumb");
                $directory = public_path("/images/models/$wide");
                $image = new Image();
                $image->make($thumbnail->getRealPath())->save($thumbDirectory,60);
                $image->make($thumbnailWide->getRealPath())->fit(1920,600)->save($directory,80);


            //About model
            $model->name = $request['name'];
            $model->about = $request['body'];
            // Body paramethre's
            $model->bust = $request['bust'];
            $model->waist = $request['waist'];
            $model->hips = $request['hips'];
            $model->dress = $request['dress'];
            $model->shoe = $request['shoe'];
            $model->hair = $request['hair'];
            $model->eyes = $request['eye'];
            $model->stature = $request['stature'];
            //Pictures & gallery id's
            $model->thumbnail = "images/models/$thumb";
            $model->thumbnail_wide = "images/models/$wide";
            $model->save();

            $lid = $model->id;



            foreach( $request['gallery'] as $gallery ):
                $modelGallery = new Attached_gallery();
                $modelGallery['type'] = "model";
                $modelGallery['type_id'] = $lid;
                $modelGallery['gallery_id'] = $gallery;
                $modelGallery->save();
            endforeach;

        }


    }

    public function modelsEdit( $id )
    {
        $models = Models::FindOrFail( $id );
        $attached = Attached_gallery::where ('type_id', $id )->get();
        $gallery = gallery::WhereNotIn('id',$attached->lists('gallery_id')->all())->get();
        $selected = gallery::whereIn('id',$attached->lists('gallery_id')->all())->get();
        return view( 'admin.models.edit', compact('models', 'gallery', 'selected') );
    }
    public function modelsEditSave( $id, editModel $request )
    {

        //dd($request->all());
        $model = Models::FindOrFail( $id );

        $storage = Storage::disk('models');
        if( $request['thumbnail'] && $request['thumbnailWide'] )
        {

            $removeStandart = explode( "/", $model['thumbnail'] );
            $removeWide = explode( "/", $model['thumbnail_wide'] );
            $storage = storage::disk('images');
            $storage->delete( "models/".$removeWide[2], "models/".$removeStandart[2] );

            $thumbnail = $request['thumbnail'];
            $extension = $request['thumbnail']->getClientOriginalExtension();

            $thumbnailWide = $request['thumbnailWide'];
            $extensionWide = $request['thumbnailWide']->getClientOriginalExtension();

                $thumb = "thumb-".parent::randomName(24).".".$extension;
                $wide = "wide-".parent::randomName(24).".".$extensionWide;
                $thumbDirectory = public_path("/images/models/$thumb");
                $directory = public_path("/images/models/$wide");
                $image = new Image();
                $image->make($thumbnail->getRealPath())->save($thumbDirectory,60);
                $image->make($thumbnailWide->getRealPath())->save($directory,60);

            $model->thumbnail = "images/models/$thumb";
            $model->thumbnail_wide = "images/models/$wide";

        }
        elseif ( $request['thumbnail'] )
        {
            $removeStandart = explode( "/", $model['thumbnail'] );
            $storage = storage::disk('images');
            $storage->delete( "models/".$removeStandart[2] );

            $thumbnail = $request['thumbnail'];
            $extension = $request['thumbnail']->getClientOriginalExtension();

            $thumb = "thumb-".parent::randomName(24).".".$extension;
            $thumbDirectory = public_path("/images/models/$thumb");
            $image = new Image();
            $image->make($thumbnail->getRealPath())->save($thumbDirectory,60);

            $model->thumbnail = "images/models/$thumb";
        }
        elseif ( $request['thumbnailWide'] )
        {
            $removeWide = explode( "/", $model['thumbnail_wide'] );
            $storage = storage::disk('images');
            $storage->delete( "models/".$removeWide[2] );

            $thumbnailWide = $request['thumbnailWide'];
            $extensionWide = $request['thumbnailWide']->getClientOriginalExtension();

            $wide = "wide-".parent::randomName(24).".".$extensionWide;
            $directory = public_path("/images/models/$wide");
            $image = new Image();
            $image->make($thumbnailWide->getRealPath())->save($directory,60);

            $model->thumbnail_wide = "images/models/$wide";
        }
            //About model
            $model->name = $request['name'];
            $model->about = $request['about'];
            // Body paramethre's
            $model->bust = $request['bust'];
            $model->waist = $request['waist'];
            $model->hips = $request['hips'];
            $model->dress = $request['dress'];
            $model->shoe = $request['shoe'];
            $model->hair = $request['hair'];
            $model->eyes = $request['eyes'];
            $model->stature = $request['stature'];
            //Pictures & gallery id's

            $model->save();
            $lid = $model->id;

            $delete = attached_gallery::where( "type_id", $id )->delete();

            if ( $request['gallery'] )
            {
                foreach( $request['gallery'] as $gid ):
                    $gallery = new attached_gallery();
                    $gallery->type = "model";
                    $gallery->type_id = $lid;
                    $gallery->gallery_id = $gid;
                    $gallery->save();
                endforeach;
            }




}
    public function modelsDelete( $id )
    {
        $model = Models::FindOrFail( $id );
        $model->delete();
        $gallery = attached_gallery::where('type_id', $id );
        $gallery->delete();

        $standart = $model['thumbnail'];
        $wide = $model['thumbnail_wide'];

        $deleteStandart = explode( "/", $standart );
        $deleteWide = explode( "/", $wide );

        $storage = Storage::disk('images');
        if($storage->exists( "models/".$deleteStandart['2'], "models/".$deleteWide['2'] ))
           $storage->delete( "models/".$deleteStandart['2'], "models/".$deleteWide['2'] );
        return redirect( url('dashboard/models/list') );

    }
 
}
