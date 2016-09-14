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
  'uses' => 'HomeController@quater'
]);

Route::get('/records/upload', 'HomeController@upload');
Route::post('/records', 'HomeController@store');
