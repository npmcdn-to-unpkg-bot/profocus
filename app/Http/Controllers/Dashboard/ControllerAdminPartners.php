<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Requests\NewPartnerRequest;
use App\Http\Requests\editPartners;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Partners;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;

class ControllerAdminPartners extends Controller
{
    //
    public function index()
    {
        $data = Partners::latest('id')->get();
        $getting = parent::getting();
        $page = Pages::Where( 'page', 'partners' )->get();
        return view('admin.partners.index', compact('getting', 'page', 'data'));
    }

    public function partnersNew()
    {
        return view('admin.partners.create');
    }
    public function partnersCreate( NewPartnerRequest $request )
    {
        $file = $request['thumbnail'];
        $extension = $file->getClientOriginalExtension();
        $fileName = "partner-".parent::randomName(24);
        $filePath = public_path('images/');
        $image = new Image();
        $image->make($file->getRealPath())->save($filePath."$fileName.$extension",70);
        $data = new Partners();
        $data->title = $request['title'];
        $data->body = $request['body'];
        $data->thumbnail = "images/$fileName.$extension";
        $data->save();
    }
    public function partnersEdit( $id, Request $request )
    {
        $data = Partners::FindOrFail( $id );
        return view( 'admin.partners.edit', compact('data') );
    }
    public function partnersEditSave( $id, editPartners $request )
    {
        $data = Partners::FindOrFail( $id );
        if($request['thumbnail'])
        {
            $file = $request['thumbnail'];
            $fileName = "partner-".parent::randomName(24);
            $filePath = public_path("images/");
            $extension = $file->getClientOriginalExtension();

            $thumbnail = explode("/",$data['thumbnail']);
            $storage = Storage::disk('images');
            $storage->delete($thumbnail[1]);

            $image = new Image();
            $image->make($file->getRealPath())->save("$filePath$fileName.$extension", 70);

            $data['thumbnail'] = "images/$fileName.$extension";
        }
        $data['title'] = $request['title'];
        $data['body'] = $request['body'];
        $data->save();
    }
    public function partnersDelete( $id )
    {
        $data = Partners::FindOrFail( $id );
        $thumbnail = explode("/",$data['thumbnail']);
        $disk = Storage::disk('images');

        if($disk->exists($thumbnail[1]))
           $disk->delete($thumbnail[1]);

        $data->delete();
        return redirect( "dashboard/partners/list" );
    }
}
