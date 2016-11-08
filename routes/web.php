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

Route::get('/notify', function () {
    // notify
    notify()->flash('You have bees', 'success',[
      'timer' => 5000,
    ]);
    return redirect()->back();
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
  Route::get('/',[
    'as' => 'home',
    'uses'=>'HomeController@index'
  ]);

  Route::get('/user/{user}',[
    'as' => 'user.profile',
    'uses' => 'HomeController@user',
  ]);







  Route::get('/tinker/{subject}', [
    'as' => 'tinker',
    'uses' => 'HomeController@tinker',
  ]);

  // tinker routes
  Route::get('/tinker/{subject}', [
    'as' => 'get.tinker',
    'uses' =>'HomeController@tinkerIndex'
  ]);

  Route::post('/tinker/{subject}', [
    'as' => 'post.tinker',
    'uses' => 'HomeController@tinkerUpload'
  ]);


  # grade group prefix routes
  Route::group(['prefix' => '{grade}'], function () {
    # subject routes group prefix
    Route::group(['prefix' => '{subject}'], function(){
      # export routes
      Route::get('/export',[
        'as' => 'export.show',
        'uses' => 'ExcelController@show'
      ]);

      Route::post('/export',[
        'as' => 'post.exportall',
        'uses' => 'ExcelController@all'
      ]);

      Route::post('/export/quarter',[
        'as' => 'post.exportquarter',
        'uses' => 'ExcelController@quarter'
      ]);
      # get quarter scores routes
       Route::get('/',[
         'as' => 'quarter.show',
         'uses' => 'ScoreController@show'
       ]);

       Route::post('/',[
         'as' => 'go.back',
         function () {
           return redirect()->back();
         }
       ]);

       # subject edit records routes
       Route::get('/{quarter}/{id}/edit', [
         'as' => 'score.show',
         'uses' => 'ScoreController@edit',
       ]);

       Route::post('/{quarter}/{id}/edit', [
         'as' => 'score.update',
         'uses' => 'ScoreController@update',
       ]);

       # upload routes
       Route::get('/upload', [
         'as' => 'upload.show',
         'uses' =>'ExcelController@index'
       ]);

       Route::post('/upload', [
         'as' => 'post.upload',
         'uses' => 'ExcelController@upload'
       ]);
    });

    # grade routes
    Route::get('/',[
      'as' => 'grade.show',
      'uses' => 'GradeController@show'
    ]);

    Route::post('/',[
      'as' => 'grade.back',
      function () {
        return redirect()->back();
      }
    ]);


    // Editing  student attendance
    Route::get('/{quarter}/{id}/edit', [
      'as' => 'show.attendance',
      'uses' => 'AttendanceController@show'
    ]);

    Route::post('/{quarter}/{id}/edit', [
      'as' => 'attendance.update',
      'uses' => 'AttendanceController@update'
    ]);

  });

  // attendance arena

});
