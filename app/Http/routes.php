<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**********************CLIENT ROUTING**********************/
Route::get('/228', 'Front\ControllerAdminSlider@uploadFiles');
//post's view
Route::get('post/{id}','Front\ControllerHome@show');

Route::get( '/', [ 'as' => 'home', 'uses' => 'Front\ControllerHome@index' ] );

//Photoroom view
Route::get('photoroom/{id}','Front\ControllerHome@photoroom');

Route::post('photoroom/single/{id}','Front\ControllerHome@single');
//Route::get('photoroom/single/{id}','Front\ControllerHome@photoroom');


Route::get( 'order/new', 'Front\ControllerHome@saveOrder');
Route::post( 'order/new', 'Front\ControllerHome@saveOrder');

Route::get( 'articles', 'Front\ControllerArticles@articles');

Route::get( 'rent', 'Front\ControllerRent@index');
Route::post( 'rent' ,'Front\ControllerRent@store');
Route::get( 'rent/{id}','Front\ControllerRent@item');

Route::get( 'models', [ 'as' => 'models', 'uses' => 'Front\ControllerModels@index' ] );
Route::post( 'models/singleModel/{id}', 'Front\ControllerModels@singleModel' );
Route::get( 'models/{id}', 'Front\ControllerModels@model' );
Route::post( 'models/{id}', 'Front\ControllerModels@model' );

Route::get( 'discount', 'Front\ControllerDiscount@index' );
Route::post('discount/discountGetSingle/{id}','Front\ControllerDiscount@discountGetSingle');

//section for study page
    // return study page
    Route::get( 'study', 'Front\ControllerStudy@index' );
    Route::post( 'study', 'Front\ControllerStudy@saveOrder' );
    Route::post( 'study/singleCourse/{id}', 'Front\ControllerStudy@singleCourse' );



Route::get('/home', 'Front\HomeController@index');

Route::get( 'partners/','Front\ControllerPartners@index');
Route::post( 'partners/singlePartners/{id}', 'Front\ControllerPartners@singlePartner' );



/**********************DASHBOARD ROUTING**********************/


$router->group(['middleware' => 'auth'], function($router)
{
    //Route::get('dashboard','ControllerAdmin@index');
    Route::get('dashboard/','Dashboard\ControllerAdmin@index');
    Route::post('dashboard/{id}','Dashboard\ControllerAdmin@status');
    Route::get('dashboard/home','Dashboard\ControllerAdminHome@index');
//Slider add
    Route::get('dashboard/slider/new','Dashboard\ControllerAdminSlider@index');
    Route::post('dashboard/slider/new','Dashboard\ControllerAdminSlider@uploadFiles');
//Slider's list
    Route::get('dashboard/slider/list','Dashboard\ControllerAdminSlider@slides');
    Route::get('dashboard/slider/edit/{id}','Dashboard\ControllerAdminSlider@edit');
    Route::post('dashboard/slider/edit/{id}','Dashboard\ControllerAdminSlider@update');
//slide's delete
    Route::get('dashboard/slider/delete/{id}','Dashboard\ControllerAdminSlider@delete');


//  Dashboard category section
    //  return categoy list page
    Route::get('dashboard/category/list','Dashboard\ControllerAdminCategory@index');
    //  make creating of category
    Route::get('dashboard/category/new','Dashboard\ControllerAdminCategory@create');
    Route::post('dashboard/category/new','Dashboard\ControllerAdminCategory@store');
    // make updating of category
    Route::get('dashboard/category/edit/{id}','Dashboard\ControllerAdminCategory@edit');
    Route::post('dashboard/category/edit/{id}','Dashboard\ControllerAdminCategory@update');
    // make removing of category
    Route::get('dashboard/category/delete/{id}','Dashboard\ControllerAdminCategory@remove');

//  Dashboard photoroom section
    //  return photorom list page
    Route::get('dashboard/photoroom/list','Dashboard\ControllerAdminPhotoroom@index');
    //  make creating of photoroom
    Route::get('dashboard/photoroom/new','Dashboard\ControllerAdminPhotoroom@create');
    Route::post('dashboard/photoroom/new','Dashboard\ControllerAdminPhotoroom@store');
    // make updating of photoroom
    Route::get('dashboard/photoroom/edit/{id}','Dashboard\ControllerAdminPhotoroom@edit');
    Route::post('dashboard/photoroom/edit/{id}','Dashboard\ControllerAdminPhotoroom@update');
    // make removing of photoroom
    Route::get('dashboard/photoroom/delete/{id}','Dashboard\ControllerAdminPhotoroom@remove');

//  Dashboard study section
    //  return study list page
    Route::get('dashboard/study/list','Dashboard\ControllerAdminStudy@index');
    //  make creating of study
    Route::get('dashboard/study/new','Dashboard\ControllerAdminStudy@create');
    Route::post('dashboard/study/new','Dashboard\ControllerAdminStudy@store');
    // make updating of study
    Route::get('dashboard/study/edit/{id}','Dashboard\ControllerAdminStudy@edit');
    Route::post('dashboard/study/edit/{id}','Dashboard\ControllerAdminStudy@update');
    // make removing of study
    Route::get('dashboard/study/delete/{id}','Dashboard\ControllerAdminStudy@remove');

//  Dashboard study orders section
//      return study orders list page
    Route::get('dashboard/study/orders/list','Dashboard\ControllerAdminStudyOrders@index');
    Route::get('dashboard/study/orders/history','Dashboard\ControllerAdminStudyOrders@history');
//      make creating of study
    Route::get('dashboard/study/new','Dashboard\ControllerAdminStudyOrders@create');
    Route::post('dashboard/study/new','Dashboard\ControllerAdminStudyOrders@store');
//     make updating of study order
    Route::get('dashboard/study/read/{id}','Dashboard\ControllerAdminStudyOrders@read');
    Route::post('dashboard/study/read/{id}','Dashboard\ControllerAdminStudyOrders@update');

    //     make history of study order
    Route::get('dashboard/study/history/{id}','Dashboard\ControllerAdminStudyOrders@historyRead');
    Route::post('dashboard/study/read/{id}','Dashboard\ControllerAdminStudyOrders@historyUpdate');

    Route::post('dashboard/study/singleApprove/{id}','Dashboard\ControllerAdminStudyOrders@singleApprove');
//     make removing of study order
    Route::get('dashboard/study/delete/{id}','Dashboard\ControllerAdminStudyOrders@remove');

//  Dashboard articles section
    //  return articles list page
    Route::get('dashboard/articles/list','Dashboard\ControllerAdminArticle@index');
    //  make creating of articles
    Route::get('dashboard/article/new','Dashboard\ControllerAdminArticle@create');
    Route::post('dashboard/article/new','Dashboard\ControllerAdminArticle@store');
    //  make updating of articles
    Route::get('dashboard/article/edit/{id}','Dashboard\ControllerAdminArticle@edit');
    Route::post('dashboard/article/edit/{id}','Dashboard\ControllerAdminArticle@update');
    //  make removing of articles
    Route::get('dashboard/article/delete/{id}','Dashboard\ControllerAdminArticle@delete');
    Route::post('dashboard/article/delete/{id}','Dashboard\ControllerAdminArticle@delete');





//left menu - pages

    Route::get('dashboard/pages/off/{id}','Dashboard\ControllerAdminPages@turn');
    Route::post('dashboard/pages/off/{id}','Dashboard\ControllerAdminPages@turn');

    Route::get('dashboard/pages/edit/{id}','Dashboard\ControllerAdminPages@edit');
    Route::post('dashboard/pages/edit/{id}','Dashboard\ControllerAdminPages@update');

//Rent


    Route::get('dashboard/location/new','Dashboard\ControllerAdminRent@locationsNew');
    Route::post('dashboard/location/new','Dashboard\ControllerAdminRent@upload');
    Route::get('dashboard/location/list','Dashboard\ControllerAdminRent@locationList');

    Route::get('dashboard/location/delete/{id}','Dashboard\ControllerAdminRent@locationDelete');
    Route::post('dashboard/location/delete/{id}','Dashboard\ControllerAdminRent@locationDelete');

    Route::get('dashboard/location/edit/{id}','Dashboard\ControllerAdminRent@locationEdit');
    Route::post('dashboard/location/edit/{id}','Dashboard\ControllerAdminRent@locationEditSave');





    Route::get('dashboard/partners/list','Dashboard\ControllerAdminPartners@index');
    Route::get('dashboard/partners/new','Dashboard\ControllerAdminPartners@partnersNew');
    Route::post('dashboard/partners/new','Dashboard\ControllerAdminPartners@partnersCreate');

    Route::get('dashboard/partners/edit/{id}','Dashboard\ControllerAdminPartners@partnersEdit');
    Route::post('dashboard/partners/edit/{id}','Dashboard\ControllerAdminPartners@partnersEditSave');

    Route::get('dashboard/partners/delete/{id}','Dashboard\ControllerAdminPartners@partnersDelete');









    Route::get('dashboard/equipment/new','Dashboard\ControllerAdminRent@equipment');
    Route::post('dashboard/equipment/new','Dashboard\ControllerAdminRent@equipmentStore');
    Route::get('dashboard/equipment/list','Dashboard\ControllerAdminRent@equipmentList');
    Route::get('dashboard/equipment/delete/{id}','Dashboard\ControllerAdminRent@equipmentDelete');
    Route::get('dashboard/equipment/edit/{id}','Dashboard\ControllerAdminRent@equipmentEdit');
    Route::post('dashboard/equipment/edit/{id}','Dashboard\ControllerAdminRent@equipmentEditUpdate');

    Route::get('dashboard/orders/list', 'Dashboard\ControllerAdminOrder@index');

    Route::get('dashboard/orders/{id}', 'Dashboard\ControllerAdminOrder@order');

//Models
    Route::get('dashboard/models/list','Dashboard\ControllerAdminModels@index');

    Route::get('dashboard/models/new','Dashboard\ControllerAdminModels@create');
    Route::post('dashboard/models/new','Dashboard\ControllerAdminModels@store');


    Route::get('dashboard/models/edit/{id}','Dashboard\ControllerAdminModels@modelsEdit');
    Route::post('dashboard/models/edit/{id}','Dashboard\ControllerAdminModels@modelsEditSave');


    Route::get('dashboard/models/delete/{id}','Dashboard\ControllerAdminModels@modelsDelete');
    Route::post('dashboard/models/delete/{id}','Dashboard\ControllerAdminModels@modelsDelete');

//Discount
    Route::get('dashboard/discount/list','Dashboard\ControllerAdminDiscount@index');

    Route::get('dashboard/discount/new','Dashboard\ControllerAdminDiscount@discountCreate');
    Route::post('dashboard/discount/new','Dashboard\ControllerAdminDiscount@discountStore');

    Route::get('dashboard/discount/edit/{id}','Dashboard\ControllerAdminDiscount@discountEditView');
    Route::post('dashboard/discount/edit/{id}','Dashboard\ControllerAdminDiscount@discountEditSave');

    Route::get('dashboard/discount/delete/{id}','Dashboard\ControllerAdminDiscount@discountDelete');
    Route::post('dashboard/discount/delete/{id}','Dashboard\ControllerAdminDiscount@discountDelete');


    /**********************************FILES - GALLERY******************************************/
    Route::get( 'dashboard/files/list', 'Dashboard\ControllerAdminFiles@index' );
    Route::get( 'dashboard/files/new', 'Dashboard\ControllerAdminFiles@create' );
    Route::post( 'dashboard/files/new', 'Dashboard\ControllerAdminFiles@store' );

    Route::get('dashboard/files/edit/{id}','Dashboard\ControllerAdminFiles@edit');
    Route::post('dashboard/files/edit/{id}','Dashboard\ControllerAdminFiles@update');

    Route::get('dashboard/files/delete/{id}','Dashboard\ControllerAdminFiles@delete');


    Route::post('dashboard/files/singleRemove/{id}','Dashboard\ControllerAdminFiles@singleRemove');




    /***************************************NETWORK'S********************************************************/
    Route::get( 'dashboard/networks/list', 'Dashboard\ControllerAdminNetwork@index' );
    Route::get( 'dashboard/networks/edit/{id}', 'Dashboard\ControllerAdminNetwork@edit' );
    Route::post( 'dashboard/networks/edit/{id}', 'Dashboard\ControllerAdminNetwork@update' );



//
//    Route::get( 'dashboard/networks/update/', 'Dashboard\ControllerAdminNetwork@update' );
//    Route::post( 'dashboard/networks/update/{id}', 'Dashboard\ControllerAdminNetwork@update' );
//
//    Route::get( 'dashboard/networks/single/', 'Dashboard\ControllerAdminNetwork@single' );
//    Route::post( 'dashboard/networks/single/{id}', 'Dashboard\ControllerAdminNetwork@single' );

    /***************************************SETTINGS********************************************************/
    Route::get( 'dashboard/setting/', 'Dashboard\ControllerAdminSetting@index' );
    Route::get( 'dashboard/setting/update/', 'Dashboard\ControllerAdminSetting@update' );
    Route::post( 'dashboard/setting/update/', 'Dashboard\ControllerAdminSetting@update' );

    /***************************************STUFF********************************************************/
    Route::get( 'dashboard/stuff/', 'Dashboard\ControllerAdminStuff@index' );
    Route::get( 'dashboard/stuff/edit/{id}', 'Dashboard\ControllerAdminStuff@update' );
    Route::post( 'dashboard/stuff/edit/{id}', 'Dashboard\ControllerAdminStuff@save' );




});


Route::auth();
Route::get('logout', function()
{
    Auth::logout();

    return Redirect::home();
});



