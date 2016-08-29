<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\settings;



class ControllerAdminSetting extends Controller
{
    //

    public function index()
    {
        $setting = settings::FindOrFail( 1 );

        return view('admin.setting.index', compact('setting'));
    }

    public function update( Request $request )
    {
       $settings = settings::FindOrFail( 1 );
       $settings['city'] = $request['city'];
       $settings['phone'] = $request['phone'];
       $settings['price'] = $request['price'];
       $settings['email'] = $request['email'];
       $settings->save();
        
    }

}
