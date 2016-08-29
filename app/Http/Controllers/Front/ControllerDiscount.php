<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\discount;
use App\Models\Pages;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class ControllerDiscount extends Controller
{
    //
    public function index()
    {
        $pages = Pages::where('page','discount')->get();
        $discount = discount::latest('created_at')->paginate(9);
        return view( 'discount.index', compact('discount','pages') );
    }

    public function discountGetSingle( $id, Request $request )
    {

        $singleData = discount::FindOrFail( $id );
        if (!$singleData['end_date'])
        {
            list($year,$mon,$day) = explode("-", $singleData['start_date']);
            $singleData['start_date'] = "Дата: $day/$mon/$year";
        }
        else
        {
            list($eYear,$eMon,$eDay) = explode("-", $singleData['end_date']);
            list($year,$mon,$day) = explode("-", $singleData['start_date']);
            $singleData['start_date'] = "Дата: $day/$mon/$year - $eDay/$eMon/$eYear";
        }
        return $singleData;


    }

}
