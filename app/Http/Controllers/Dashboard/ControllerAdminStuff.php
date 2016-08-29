<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pages;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Models\stuff;
class ControllerAdminStuff extends Controller
{
    //
  public function index()
  {
      $stuff = stuff::where('page','rent')->get();
      return view('admin.stuff.index', compact('stuff'));
  }

    public function update($id)
    {
        $stuff = stuff::findorfail($id);
        return view('admin.stuff.edit', compact('stuff'));
    }

    public function save($id, Request $request)
    {
        $stuff = stuff::findorfail($id);
        $stuff['title'] = $request['title'];
        $stuff['body'] = $request['body'];
        $stuff->save();
    }

}
