<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\files;
use App\models\Locations;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models;

use App\Models\Home;
use App\Models\Pages;
use App\Models\Slider;
use App\Models\event;
use App\Models\Photoroom;
use App\Models\Author;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Category;
use App\Models\Attached_gallery;
use App\Models\gallery;
class ControllerHome extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Pages::where('page','home')->get();

        $category = Category::Latest('id')->get();

        $slider = slider::latest('id')->get();
        return view( 'home.home', compact('slider','page', 'category') ) ;
    }

   public function show($id)
   {
       $news = Home::find($id);
       return view('posts.post', compact('news'));
   }

    public function photoroom($id)
    {
        $category = Category::FindOrFail($id);
        $sessions = Photoroom::where('category',$id)->get();
        return view('photoroom.index', compact('category','sessions'));
    }

    public function Single($id)
    {
        $single = Photoroom::FindOrFail($id);

        //return $gallery_ids[0]['gallery_id'];
        $files = files::where('gallery', $single['gallery'])->get();
        $a = [ $files, $single ];
        return $a;
    }

    public function saveOrder(Requests\NewOrderRequest $request)
    {
        $order = new event();
        $rand = parent::randomName(64);
        $order['name'] = $request['name'];
        $order['uniq'] = $rand;
        $order['email'] = $request['email'];
        $order['phone'] = $request['phone'];
        $order['note'] = $request['note'];
        $order->save();
    }

}
