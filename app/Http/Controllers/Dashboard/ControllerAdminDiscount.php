<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Requests\NewDiscountRequest;
use App\Http\Requests\editDiscount;
use App\Http\Requests;
use App\Models\discount;
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Facades\Storage;

class ControllerAdminDiscount extends Controller
{
    //
    public function index()
    {
        $data = discount::latest('id')->get();
        $getting = parent::getting();
        $page = Pages::Where( 'page', 'discount' )->get();
        return view('admin.discount.index', compact('getting', 'page', 'data'));
    }
    public function discountCreate()
    {
        return view('admin.discount.create');
    }
    public function discountStore( NewDiscountRequest $request )
    {
        $data = new discount();
        $data->title = $request['title'];
        $data->body = $request['body'];
        $data->discount = $request['discount'];
        $data->start_date = $request['start'];
        $data->end_date = $request['end'];
        if( $request['thumbnail'] )
        {
            $file = $request['thumbnail'];
            $fileName = parent::randomName(24);
            $extension = $file->getClientOriginalExtension();
            $path = public_path("images/discount-$fileName.$extension");

            $image = new Image();
            $image->make($file->getRealPath())->save($path, 70);
            $data->thumbnail = "images/discount-$fileName.$extension";
        }
        $data->save();
    }
    public function discountList()
    {
        $data = discount::latest('id')->get();
        return view( "admin.discount.list", compact('data') );
    }
    public function discountEditView( $id )
    {
        $data = discount::FindOrFail( $id )->toArray();



        if( $data['start_date'] && $data['end_date'] )
        {
            list($year, $mon, $day) = explode('-', $data['start_date']);
            $data['start_date'] = "$mon/$day/$year";

            list($eYear, $eMon, $eDay) = explode('-', $data['end_date']);
            $data['end_date'] = "$eMon/$eDay/$eYear";
        }
        elseif ( $data['start_date'] && !$data['end_date'] )
        {
            list($year, $mon, $day) = explode('-', $data['start_date']);
            $data['start_date'] = "$mon/$day/$year";

            $data['end_date'] = "";
        }


        return view( "admin.discount.edit", compact('data') );
    }


    public function discountEditSave( $id, editDiscount $request )
    {
        $data = discount::FindOrFail($id);
        //mm/dd/yyyy

        if ($request['start'] && $request['end']) {
            list($mon, $day, $year) = explode('/', $request['start']);
            $startDate = "$year-$mon-$day";

            list($eMon, $eDay, $eYear) = explode('/', $request['end']);
            $endDate = "$eYear-$eMon-$eDay";
        }
        elseif ( $request['start'] && !$request['end'])
        {
            list($mon, $day, $year) = explode('/', $request['start']);
            $startDate = "$year-$mon-$day";
            $endDate = null;
        }


//        dd($request->all());
        if( $request['thumbnail'] )
        {
            $img = explode( "/", $data['thumbnail'] );
            $disk = Storage::disk('images');

            if($disk->exists( $img[1] ))
               $disk->delete( $img[1] );

            $file = $request['thumbnail'];
            $fileName = parent::randomName(24);
            $extension = $file->getClientOriginalExtension();
            $path = public_path("images/discount-$fileName.$extension");
            $data->thumbnail = "images/discount-$fileName.$extension";

            $image = new Image();
            $image->make($file->getRealPath())->save($path, 70);
        }

            $data->title = $request['title'];
            $data->body = $request['body'];
            $data->discount = $request['discount'];
            $data->start_date = $startDate;
            $data->end_date = $endDate;

            $data->save();

    }
    public function discountDelete( $id )
    {
        $data = discount::FindOrFail( $id );
        $img = explode( "/", $data['thumbnail'] );
        $disk = Storage::disk('images');

        if($disk->exists( $img[1] ))
           $disk->delete( $img[1] );

        $data->delete();

        return redirect( url("dashboard/discount/list") );

    }



}
