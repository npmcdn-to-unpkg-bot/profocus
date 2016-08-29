<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Pages;
use App\Models\course;
use App\Models\studyOrders;
use App\Http\Requests\NewCourseOrder;
class ControllerStudy extends Controller
{
    //
    public function index()
    {
        $course = course::Latest('id')->get();
        $page = Pages::where('page','study')->get();
        return view( 'study.index', compact('page','course') );
    }

    public function singleCourse($id)
    {
        return $data = course::where('id',$id)->first();
    }

    public function saveOrder(NewCourseOrder $request)
    {

        $uniq = parent::randomName(64);
            $data = new studyOrders();
            $data['name'] = $request['name'];
            $data['email'] = $request['email'];
            $data['uniq'] = $uniq;
            $data['approved'] = NULL;
            $data['phone'] = $request['phone'];
            $data['course_id'] = $request['course'];
            $data['note'] = $request['body'];

        $data->save();

    }
}
