<?php

namespace App\Http\Controllers\Front;

use App\models\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ControllerArticles extends Controller
{
    //
    public function articles(  )
    {
        $articles = Article::latest('id')->paginate(6);

        return view('articles.index', compact('articles'));

    }


}
