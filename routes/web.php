<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/',[
  'as' => 'home',
  'uses'=>'HomeController@index'
]);

Route::get('/user/{user}',[
  'as' => 'user.profile',
  'uses' => 'HomeController@user',
]);

Route::get('/subject/{subject}',[
  'as' => 'user.subject',
  'uses' => 'HomeController@quarter'
]);

Route::post('/subject/{subject}',[
  'as' => 'go.back',
  function () {
    return redirect()->back();
  }
]);

Route::get('/export/{subject}',[
  'as' => 'get.export',
  'uses' => 'ExcelController@indexExport'
]);

Route::post('/export/{subject}',[
  'as' => 'post.export',
  'uses' => 'ExcelController@export'
]);

Route::get('/upload/{subject}', [
  'as' => 'get.upload',
  'uses' =>'ExcelController@indexUpload'
]);

Route::post('/upload/{subject}', [
  'as' => 'post.upload',
  'uses' => 'ExcelController@upload'
]);

Route::get('/tinker/{subject}', [
  'as' => 'tinker',
  'uses' => 'HomeController@tinker',
  ]);
