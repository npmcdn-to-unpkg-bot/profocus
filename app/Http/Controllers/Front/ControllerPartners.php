<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Partners;
use App\Models\Pages;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class ControllerPartners extends Controller
{
    //
    public function index()
    {
       $page = Pages::where('page', 'partners')->get();
       $data = Partners::latest('id')->paginate(6);
        return view( 'partners.index', compact('data','page') );
    }

    public function singlePartner( $id )
    {
        $partner = Partners::FindOrFail( $id );
        return $partner;
    }
}
