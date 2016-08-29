<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Pages;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;


class ControllerAdminHome extends Controller
{
    //


    public function index()
    {
        $page = Pages::Where( "page", "home" )->get();

        $getting = parent::getting();
        return view('admin.home.index', compact('getting', 'page') );
    }

}
