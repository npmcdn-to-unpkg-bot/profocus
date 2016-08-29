<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\studyOrders;
use App\Models\course;
use Illuminate\Support\Facades\Input;
class ControllerAdminStudyOrders extends Controller
{
    //
    public function index()
    {
        $data = studyOrders::Latest('id')->where('approved', null)->get();
        return view( 'admin.study.orders.index', compact('data') );
    }
    public function history()
    {
        $data = studyOrders::Latest('id')->where('approved', 'yes')->get();
        return view( 'admin.study.orders.history', compact('data') );
    }

    public function read($id)
    {
        $data = studyOrders::FindOrFail($id);
        $course_id = $data['course_id'];
        $course = course::FindOrFail($course_id);

        return view( 'admin.study.orders.edit', compact('data','course') );
    }
    public function historyRead($id)
    {
        $data = studyOrders::FindOrFail($id);
        $course_id = $data['course_id'];
        $course = course::FindOrFail($course_id);

        return view( 'admin.study.orders.historyRead', compact('data','course') );
    }

    public function singleApprove($id, Request $request)
    {
//      return $request->all();
        $data = studyOrders::FindOrFail($id);

        if($request['Approved'] == 'yes')
        {
            $data['approved'] = $request['Approved'];
            $data->save();
        }
        elseif ($request['Approved'] == 'no')
        {
            $data->delete();
        }

    }
}
