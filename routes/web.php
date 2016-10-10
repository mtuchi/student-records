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

Route::get('/{subject}',[
  'as' => 'user.subject',
  'uses' => 'HomeController@quarter'
]);

Route::post('/{subject}',[
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

Route::get('/tinker/{subject}', [
  'as' => 'get.tinker',
  'uses' =>'HomeController@tinkerIndex'
]);

Route::post('/tinker/{subject}', [
  'as' => 'post.tinker',
  'uses' => 'HomeController@tinkerUpload'
]);

Route::get('/{subject}/{quarter}/edit/{id}', [
  'as' => 'get.edit',
  'uses' => 'HomeController@indexEdit',
]);

Route::post('/{subject}/{quarter}/edit/{id}', [
  'as' => 'post.edit',
  'uses' => 'HomeController@edit',
]);
