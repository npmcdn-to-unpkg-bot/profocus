<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pages;
use App\Http\Requests\UpdatePageRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
class ControllerAdminPages extends Controller
{

    public function edit( $id, Request $request )
    {
        if($id == 1)
           $pageTmp = 1;
        else
            $pageTmp = '';
        $data = Pages::FindOrFail( $id );
        return view('admin.pages.edit', compact('data', 'pageTmp'));

    }

    public function update( $id, UpdatePageRequest $request )
    {
        $data = Pages::FindOrFail( $id );
        $data['title'] = $request['title'];
        $data['body'] = $request['body'];
        if( $request->file('file') )
        {
            $disk = Storage::disk('images');
            if ($disk->exists($data['file']))
                $disk->delete($data['file']);

            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();
            $name = parent::randomName(24);

            $directory = public_path("/images/$name.$ext");
            $image = new Image();
            $image->make($file->getRealPath())->save($directory,60);

            $data['thumbnail'] = "images/$name.$ext";
            $data['file'] = "$name.$ext";
        }

        $data->save();
    }

    public function turn( $id, Request $request )
    {
        $data = Pages::FindOrFail( $id );

        if ($data['enable'] == 'yes')
            $data['enable'] = "no";
        elseif ($data['enable'] == 'no')
            $data['enable'] = "yes";
        else
            $data['enable'] = "yes";

        $data->save();
        return redirect($_SERVER['HTTP_REFERER']);
    }
}
