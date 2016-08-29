<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use App\Models\Category;
use App\Http\Requests\NewCategoryRequest;
use App\Http\Requests\editCategory;

class ControllerAdminCategory extends Controller
{
    //
	public function index()
	{
	    $data = Category::latest('id')->get();
		return view( 'admin.home.category.index', compact('data') );
	}

    public function create()
    {
        return view( 'admin.home.category.create' );

	}

	public function store(NewCategoryRequest $request)
	{
		//dd($request->all());

		$data = new Category();
		$data['title'] = $request['title'];
		$data['about'] = $request['body'];

		
            $fileName = parent::randomName( 24 );
            $file = $request->file( 'thumbnail' );
            $extension =  $file->getClientOriginalExtension();
            $thumbPath = public_path( 'images/category/' . "$fileName.$extension" );

            $fileWide = $request->file( 'wide' );
            $extensionWide =  $fileWide->getClientOriginalExtension();
            $widePath = public_path( 'images/category/' . "wide-$fileName.$extensionWide" );

            $Image = new Image();
            $Image->make( $file->getRealPath() )->fit(370,550)->save( $thumbPath, 60 );
            $Image->make( $fileWide->getRealPath() )->fit(1920,600)->save( $widePath, 60 );

			$data['wide_bg'] = "images/category/wide-$fileName.$extension";
			$data['thumbnail'] = "images/category/$fileName.$extension";

		$data->save();
		
		
	}

	public function edit($id)
	{
		$data = Category::FindOrFail($id);
		return view('admin.home.category.edit', compact('data'));
	}

	public function update($id, editCategory $request)
	{
		$data = Category::FindOrFail($id);
		$data['title'] = $request['title'];
		$data['about'] = $request['about'];


		if($request->file('thumbnail') && $request->file('wide_bg') )
		{
			// remove files from storage before upload new
			$wFile = explode("/", $data['wide_bg']);
			$wDelete = $wFile[2];

			$tFile = explode("/", $data['thumbnail']);
			$tDelete = $tFile[2];
			$disk = Storage::disk('images');
			if($disk->exists("category/$wDelete", "category/$tDelete"))
			   $disk->delete("category/$wDelete", "category/$tDelete");

			// creating new file attributes
			$fileName = parent::randomName( 24 );
			$folder = "images/category";
			$file = $request->file( 'thumbnail' );
			$extension =  $file->getClientOriginalExtension();
			$thumbPath = public_path( 'images/category/' . "$fileName.$extension" );

			$fileWide = $request->file( 'wide_bg' );
			$extensionWide =  $fileWide->getClientOriginalExtension();
			$widePath = public_path( 'images/category/' . "wide-$fileName.$extensionWide" );

			// Make images
			$Image = new Image();
			$Image->make( $file->getRealPath() )->fit(370,550)->save( $thumbPath, 60 );
			$Image->make( $fileWide->getRealPath() )->fit(1920,600)->save( $widePath, 60 );

			// Save path to database
			$data['wide_bg'] = "$folder/wide-$fileName.$extension";
			$data['thumbnail'] = "$folder/$fileName.$extension";
		}
		else if($request->file('thumbnail'))
		{
			// remove files from storage before upload new
			$tFile = explode("/", $data['thumbnail']);
			$tDelete = $tFile[2];
			$disk = Storage::disk('images');
			if($disk->exists("category/$tDelete"))
			   $disk->delete("category/$tDelete");

			// creating new file attributes
			$fileName = parent::randomName( 24 );
			$folder = "images/category";
			$file = $request->file( 'thumbnail' );
			$extension =  $file->getClientOriginalExtension();
			$thumbPath = public_path( 'images/category/' . "$fileName.$extension" );

			// Make image
			$Image = new Image();
			$Image->make( $file->getRealPath() )->fit(370,550)->save( $thumbPath, 60 );

			// Save path to database
			$data['thumbnail'] = "$folder/$fileName.$extension";
		}
        else if($request->file('wide_bg'))
		{
			// remove files from storage before upload new
			$wFile = explode("/", $data['wide_bg']);
			$wDelete = $wFile[2];

			$disk = Storage::disk('images');
			if($disk->exists("category/$wDelete"))
			   $disk->delete("category/$wDelete");

			// creating new file attributes
			$fileName = parent::randomName( 24 );
			$folder = "images/category";

			$fileWide = $request->file( 'wide_bg' );
			$extensionWide =  $fileWide->getClientOriginalExtension();
			$widePath = public_path( 'images/category/' . "wide-$fileName.$extensionWide" );

			// Make image
			$Image = new Image();
			$Image->make( $fileWide->getRealPath() )->fit(1920,600)->save( $widePath, 60 );

			// Save path to database
			$data['wide_bg'] = "$folder/wide-$fileName.$extensionWide";
		}

		$data->save();
	}

	public function remove($id)
	{
		$data = Category::FindOrFail($id);
		$disk = Storage::disk('images');
		$folder = "category";

		$wFile = explode("/", $data['wide_bg']);
		$wDelete = $wFile[2];

		$tFile = explode("/", $data['thumbnail']);
		$tDelete = $tFile[2];

		if($disk->exists("$folder/$wDelete", "$folder/$tDelete"))
		   $disk->delete("$folder/$wDelete", "$folder/$tDelete");


		$data->delete();
		return redirect(url('dashboard/category/list'));

	}
}
