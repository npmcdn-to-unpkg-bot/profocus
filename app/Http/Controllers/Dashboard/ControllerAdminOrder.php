<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\event;
use App\Models\Time;
use App\Models\Locations;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ControllerAdminOrder extends Controller
{
    //
    public function index()
    {
        $data1 = event::latest('id')->groupBy('uniq')->get();
        return view('admin.rent.orders.index',compact('data1'));
    }

    public function order($id)
    {
        $data = event::FindOrFail($id);
        $array_id = event::select('place')->where('uniq',$data['uniq'])->get();
        $location = locations::whereIn('id',$array_id->lists('place')->all())->get();

        $time = time::where('uniq',$data['uniq'])->get();
        //return $location;
        return view('admin.rent.orders.order',compact('data','time','location'));
    }
}
