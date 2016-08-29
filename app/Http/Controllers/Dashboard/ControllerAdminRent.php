<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Locations;
use App\Models\Pages;
use App\Models\Photoroom;
use Intervention\Image\ImageManager as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use App\Models\Rent;
use App\Models\files;
use App\Models\gallery;
use Illuminate\Support\Facades\Input;
use App\Models\event;
use App\Models\equipment;
use App\Models\Attached_gallery;
use App\Http\Requests\newLocation;
use App\Http\Requests\editLocation;

class ControllerAdminRent extends Controller
{
    //
    public function index()
    {
        $getting = parent::getting();
        $page = Pages::Where( 'page', 'rent' )->get();
        return view('admin.rent.index', compact('getting', 'page'));
    }

    public function locationsNew()
    {
        $gallerys = gallery::all();
        return view('admin.rent.locations.add', compact('gallerys'));
    }

    public function upload(newLocation $request)
    {
        //dd($request->all());

        if($request['thumbnail'])
        {
            //Filesystem work
            $name = parent::randomName(24);
            $file = $request['thumbnail'];
            $extension = $file->getClientOriginalExtension();
            $path = public_path("images/location-$name.$extension");
            $Image = new Image();
            $Image->make($file->getRealPath())->fit(370, 231)->save($path,50);
            //Database work
            $location = new Locations();
            $location->title = $request['title'];
            $location->body = $request['body'];
            $location->file = "location-$name.$extension";
            $location->thumbnail = "images/location-$name.$extension";
            $location->save();

            $lid = $location->id;

            foreach( $request['gallery'] as $id ):

                $gallery = new attached_gallery();
                $gallery->type = "location";
                $gallery->type_id = $lid;
                $gallery->gallery_id = $id;
                $gallery->save();

            endforeach;
        }


    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locationList()
    {
        $data = Locations::latest('id')->get();
        return view('admin.rent.locations.index', compact('data'));
    }
    public function locationEdit( $id )
    {
        $data = Locations::findorfail( $id );
        $attached = attached_gallery::where ('type_id', $id )->get();
        $gallery = gallery::WhereNotIn('id',$attached->lists('gallery_id')->all())->get()->toArray();
        $selected = gallery::whereIn('id',$attached->lists('gallery_id')->all())->get()->toArray();
        return view('admin.rent.locations.edit', compact('data','selected','gallery'));
        }

    public function locationEditSave( $id, editLocation $request )
    {
        $location = Locations::FindOrFail( $id );
        $lid = $location->id;
        $session = Photoroom::where('location', $location['title'])->first();


        if ( $request['thumbnail'] )
        {
            if(Storage::disk('images')->exists($location['file']))
               Storage::disk('images')->delete($location['file']);

            $name = parent::randomName(24);
            $file = $request['thumbnail'];
            $extension = $file->getClientOriginalExtension();
            $path = public_path("images/location-$name.$extension");
            $Image = new Image();
            $Image->make($file->getRealPath())->fit(370, 231)->save($path,50);

            $location->file = "location-$name.$extension";
            $location->thumbnail = "images/location-$name.$extension";
        }

        //database work
        $session['location'] = $request['title'];
        $session->save();
        $location->title = $request['title'];
        $location->body = $request['body'];
        $location->save();


        if ( $request['gallery'] )
		{
            $delete = attached_gallery::where( "type_id", $id )->delete();
            foreach( $request['gallery'] as $gid ):
            $gallery = new attached_gallery();
            $gallery->type = "location";
            $gallery->type_id = $lid;
            $gallery->gallery_id = $gid;
            $gallery->save();
        endforeach;
		}

    }

    public function locationDelete( $id )
    {
        $location = Locations::findorfail( $id );
        $gallery = attached_gallery::where('type_id', $id );

        if(Storage::disk('images')->exists($location['file']))
           Storage::disk('images')->delete($location['file']);

        $location->delete();
        $gallery->delete();
        return redirect( "dashboard/location/list" );
    }

    /*********************************************************************/






    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store()
    {
        return view('admin.rent.events.new');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function save(Request $request )
    {
        return $request->all();
    }








    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function equipment(Request $request )
    {
        return view('admin.rent.equipment.new');
    }

    /**
     * @param Request $request
     */
    public function equipmentStore(Requests\newEquipment $request )
    {
        $f = $request['thumbnail'];
        $ext = $f->getClientOriginalExtension();

        $name = parent::randomName(24) . ".$ext";

        $Path = "images/equipment/$name";

        $Image = new Image();
        $Image->make($f->getRealPath())->fit(370,246)->save($Path, 50);

        $equipment = new equipment();
        $equipment->title = $request['title'];
        $equipment->thumbnail = $Path;
        $equipment->file = $name;

        $equipment->save();

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function equipmentList(Request $request )
    {
        $data = equipment::latest()->get();
        return view('admin.rent.equipment.index', compact('data'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function equipmentEdit($id, Request $request )
    {
        $data = equipment::findorfail($id);
        return view('admin.rent.equipment.edit', compact('data'));
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function equipmentEditUpdate($id, Requests\editEquipment $request )
    {
        $data = equipment::findorfail($id);
        $r = $request->all();


        if ($request->file('thumbnail'))
        {
            $filee = $data['file'];

            if(Storage::disk('images')->exists("equipment/$filee"))
               Storage::disk('images')->delete("equipment/$filee");

            $fileName = parent::randomName(24);
            $f = $request->file('thumbnail');
            $ext =  $f->getClientOriginalExtension();
            $Path = "images/equipment/$fileName.$ext";

            $Image = new Image();
            $Image->make($f->getRealPath())->fit(370,246)->save($Path, 50);

            $data->title = $r['title'];
            $data->thumbnail = "images/equipment/$fileName.$ext";
            $data->file = $fileName.$ext;

            $data->save();

        }
        else {
            $data->title = $r['title'];
            $data->save();

        }
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function equipmentDelete($id, Request $request )
    {
        $file = equipment::FindOrFail( $id );
        $d = $file['file'];
        if(Storage::disk('images')->exists("equipment/$d"))
           Storage::disk('images')->delete("equipment/$d");
        $data = equipment::findorfail($id);
        $data->delete();
        return redirect( "/dashboard/equipment/list" );
    }

}
