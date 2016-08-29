<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Models;
use App\Models\Pages;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\gallery;
use App\Models\Attached_gallery;
use App\Models\files;


class ControllerModels extends Controller
{
    //
    public function index()
    {
        $page = Pages::where('page', 'models')->get();
        $models = Models::latest('id')->paginate(9);
        return view('models.models', compact('models','page'));
    }


    public function singleModel( $id, Request $request )
    {
        $model = Models::FindOrFail( $id );
        return $model;
    }
    public function model( $id )
    {
        $model = Models::FindOrFail( $id );
        $gallery_ids = attached_gallery::where ('type_id', $id )->get();
        $gallery = gallery::whereIn('id',$gallery_ids->lists('gallery_id')->all())->get();
        $files = files::latest('id')->whereIn('gallery',$gallery_ids->lists('gallery_id')->all())->paginate(16);
        return view( 'models.model', compact('model', 'files') );
    }
}
