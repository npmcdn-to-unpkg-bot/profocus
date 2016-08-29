<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager as Image;
use Illuminate\Support\Facades\Storage;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\NewArticleRequest;
use App\Http\Requests\EditArticleRequest;
use App\Models\Article;


class ControllerAdminArticle extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Отображает главную страницу!
     */
    public function index()
    {
        $data = Article::latest('created_at')->get();
        return view('admin.articles.index', compact('data'));
    }


    public function create()
    {
        return view('admin.articles.create');
    }
    /**
     * Сохранение новой статьи в базе данных!
     */
    public function store(NewArticleRequest $request)
    {

        $article = new Article();
        $article->title = $request['title'];
        $article->body = $request['body'];

        if ($request->file('thumbnail'))
        {
            $fileName = parent::randomName( 24 );
            $file = $request->file( 'thumbnail' );
            $extension =  $file->getClientOriginalExtension();
            $thumbPath = public_path( 'images/articles/' . "$fileName.$extension" );
            $Image = new Image();
            $Image->make( $file->getRealPath() )->save( $thumbPath, 60 );
            $article->thumbnail = "images/articles/$fileName.$extension";
            $article->file = "$fileName.$extension";
        }

        $article->save();


    }

    /**
     * Отображение формы для редактирования статьи и подгрузка в нее данных!
     */
    public function edit($id )
    {
         $article = Article::findorfail( $id );

        return view('admin.articles.edit',compact('article'));
    }

    /**
     * Обновления статьи!
     */
    public function update($id, EditArticleRequest $request )
    {
        $r = $request->all();
        $article = Article::findorfail( $id );
        $article->title = $r['title'];
        $article->body = $r['body'];

        if ($request->file('thumbnail'))
        {
            $file = $article['file'];
            if (Storage::disk('images')->exists( "articles/$file" ))
                Storage::disk('images')->delete( "articles/$file" );

            $fileName = parent::randomName(24);
            $file = $request->file( 'thumbnail' );
            $extension =  $file->getClientOriginalExtension();
            $thumbPath = public_path( 'images/articles/' . "$fileName.$extension" );
            $Image = new Image();
            $Image->make( $file->getRealPath() )->save( $thumbPath, 60 );
            $article->thumbnail = "images/articles/$fileName.$extension";
            $article->file = "$fileName.$extension";

        }

        $article->save();


    }

    /**
     * Удаление статьи из базы и файлов с сервера!
     */
    public function delete($id, Request $request )
    {
        $article = Article::find( $request->id );
        $file = $article['file'];
        if (Storage::disk('images')->exists( "articles/$file" ))
            Storage::disk('images')->delete( "articles/$file" );

        $article->delete();
        return redirect( "dashboard/articles/list" );
    }

}
