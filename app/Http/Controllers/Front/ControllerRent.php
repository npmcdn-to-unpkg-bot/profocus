<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\files;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Rent;
use App\Models\Pages;
use App\Models\Locations;
use App\Models\gallery;
use App\Models\event;
use App\Models\equipment;
use Illuminate\Support\Facades\Input;
use App\Models\stuff;
use App\Models\Attached_gallery;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Time;
use App\Models\Days;
class ControllerRent extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $stuff = stuff::where('page','rent')->get();
        $days  = days::all();
        $json = $days;
        $page = Pages::where('page','rent')->get();
        $locations = Locations::latest('id')->get();
        
        
        
        $equipment = equipment::latest('id')->get();
        return view( 'rent.rent', compact('page','locations','equipment','json','stuff') );
    }

    public function store( Request $request )
    {

        return $request->all();
    }
    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function item($id, Request $request )
    {
        $item = Locations::find( $id );
        $gallery_ids = attached_gallery::where ('type_id', $id )->get();
        $gallery = gallery::whereIn('id',$gallery_ids->lists('gallery_id')->all())->get();
        $files = files::latest('id')->whereIn('gallery',$gallery->lists('id')->all())->paginate(16);
        return view('rent.view', compact('item','files'));
    }

}
