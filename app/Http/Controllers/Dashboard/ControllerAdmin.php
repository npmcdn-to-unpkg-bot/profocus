<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pages;


class ControllerAdmin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::all();
        return view( 'admin.index', compact('pages') );
    }
    public function status( $id, Request $request )
    {
        $page = Pages::FindOrFail( $request['id'] );
        $page['enable'] = $request['status'];
        $page->save();
    }


}
