<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ControllerPhotoroom extends Controller
{
    //
    public function index()
    {
        return view( 'photoroom.index' );
    }
}
