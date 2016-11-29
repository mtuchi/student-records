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
  # user profile settings


  Route::get('/',[
    'as' => 'home',
    'uses'=>'HomeController@index'
  ]);

  Route::get('/settings/{user}', [
    'as' => 'user.show',
    'uses' => 'UserController@show'
  ]);

  Route::get('/settings/profile/edit', [
    'as' => 'settings.update',
    'uses' => 'UserController@update'
  ]);


  Route::get('/tinker', [
    'as' => 'tinker',
    'uses' => 'HomeController@tinker',
  ]);


  # grade group prefix routes
  Route::group(['prefix' => '{grade}'], function () {
    # student profile
    Route::get('/{id}/profile', [
      'as' => 'student.show',
      'uses' => 'StudentController@show'
    ]);

    Route::get('/{id}/student', [
      'as' => 'singlestudent.show',
      'uses' => 'StudentController@student'
    ]);

    # upload routes
    Route::get('/upload', [
      'as' => 'uploadattendance.show',
      'uses' =>'AttendanceController@showupload'
    ]);

    Route::post('/upload', [
      'as' => 'uploadattendance.store',
      'uses' => 'AttendanceController@storeupload'
    ]);

    # export routes for grade attendance
    Route::get('/export',[
      'as' => 'exportattendance.show',
      'uses' => 'ExportAttendanceController@show'
    ]);

    Route::post('/export',[
      'as' => 'exportattendance.all',
      'uses' => 'ExportAttendanceController@all'
    ]);

    Route::post('/export/quarter',[
      'as' => 'exportattendance.quarter',
      'uses' => 'ExportAttendanceController@quarter'
    ]);

    Route::post('/export/month',[
      'as' => 'exportattendance.month',
      'uses' => 'ExportAttendanceController@month'
    ]);
    # subject routes group prefix
    Route::group(['prefix' => '{subject}'], function(){
      # export routes for subject
      Route::get('/export',[
        'as' => 'exportscore.show',
        'uses' => 'ExportScoreController@show'
      ]);

      Route::post('/export',[
        'as' => 'exportscore.all',
        'uses' => 'ExportScoreController@all'
      ]);

      Route::post('/export/quarter',[
        'as' => 'exportscore.quarter',
        'uses' => 'ExportScoreController@quarter'
      ]);

      Route::post('/export/month',[
        'as' => 'exportscore.month',
        'uses' => 'ExportScoreController@month'
      ]);
      # get quarter scores routes
       Route::get('/',[
         'as' => 'quarter.show',
         'uses' => 'ScoreController@show'
       ]);

       Route::post('/',[
         'as' => 'quarter.back',
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
         'as' => 'uploadscore.show',
         'uses' =>'ScoreController@showupload'
       ]);

       Route::post('/upload', [
         'as' => 'uploadscore.store',
         'uses' => 'ScoreController@storeupload'
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
      'as' => 'attendance.show',
      'uses' => 'AttendanceController@show'
    ]);

    Route::post('/{quarter}/{id}/edit', [
      'as' => 'attendance.update',
      'uses' => 'AttendanceController@update'
    ]);

  });

  // attendance arena

});
