<?php

use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// Auth::routes();


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/sitemap',['uses'=>'SitemapController@index','as'=>'indexSitemap']);


Route::get('/404',['uses'=>'ContentController@error404','as'=>'404']);
Route::group(['prefix'=>'admin'],function(){
	Route::get('/',['uses'=>'AdminController@index','as'=>'indexAdmin']);
});

Route::get('/',['uses'=>'IndexController@index','as'=>'indexHome']);
Route::post('/search',['uses'=>'ContentController@search','as'=>'postSearch']);
Route::get('/s/{id}',['uses'=>'ContentController@setSearch','as'=>'setSearch']);

Route::get('/40-top-chart-prambors-radio/all',['uses'=>'ChartController@chartPrambors','as'=>'chartPrambors']);
Route::get('/40-top-chart-musik-indonesia/all',['uses'=>'ChartController@chartIndonesia','as'=>'chartIndonesia']);

// Route::get('/{slug}',['uses'=>'ContentController@getPage','as'=>'getPage']);
Route::get('/{slug}',function($slug){
    return redirect(route('getContent', $slug));
});
Route::get('/download/{id}/{slug}',function(){
	return redirect(route('indexHome'));
});
Route::get('/download/{slug}',['uses'=>'ContentController@getContent','as'=>'getContent']);


Route::get('/home', 'HomeController@index');

