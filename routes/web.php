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

#vuejs test return
#Route::post('/addteacher','HomeController@store');

Route::group(['middleware' => 'auth'], function () {
	# group prefix for students routes
	Route::group(['prefix' => '/students'], function () {
		#student list
		Route::get('/', 'StudentController@index');
		#add student
		Route::get('/create', 'StudentController@create');
		# store student
		Route::post('/','StudentController@store');
		#prefix with student id
		Route::group(['prefix' => '{id}'], function(){
			#show profile
			Route::get('/', [
				'as' => 'student.show',
				'uses' => 'StudentController@show'
			]);
			# save updates
			Route::get('/edit', [
				'as' => 'student.edit',
				'uses' => 'StudentController@edit'
			]);

			Route::put('/', [
				'as' => 'student.update',
				'uses' => 'StudentController@update'
			]);

			Route::delete('/', [
				'as' => 'student.destroy',
				'uses' => 'StudentController@destroy'
			]);
		});

	});
  #get teacher list
  Route::get('/teacherlist', 'TeacherController@list');
	#add teacher
  Route::get('/addteacher', 'TeacherController@create');
	# store teacher
	Route::post('/addteacher','TeacherController@store');
	#assaign teacher
	Route::get('/{id}/assaign', [
		'as' => 'assaign.show',
		'uses' =>'AssaignTeacherController@show'
		]);

  #update
  Route::post('/{id}/assaign', [
		'as' => 'assaign.edit',
		'uses' =>'AssaignTeacherController@edit'
		]);
  #show profile
	Route::get('/{id}/show', [
		'as' => 'teacher.show',
		'uses' => 'TeacherController@show'
	]);
	# save updates
	Route::get('/{id}/edit', [
		'as' => 'teacher.edit',
		'uses' => 'TeacherController@edit'
	]);

	Route::put('/{id}/edit', [
		'as' => 'teacher.update',
		'uses' => 'TeacherController@update'
	]);

  Route::get('/{id}/delete',[
		'as' => 'teacher.delete',
		'uses' => 'TeacherController@delete'
	]);

  Route::delete('/{id}/delete', [
		'as' => 'teacher.destroy',
		'uses' => 'TeacherController@destroy'
	]);

  # user profile settings
  Route::get('/pdf', [
    'as' => 'test',
    'uses' => 'StudentGradeController@print'
  ]);

  Route::get('/',[
    'as' => 'home',
    'uses'=>'HomeController@index'
  ]);

  Route::get('/settings/{user}', [
    'as' => 'user.show',
    'uses' => 'UserController@show'
  ]);

	Route::get('/settings/{user}/edit', [
		'as' => 'user.edit',
		'uses' => 'UserController@edit'
	]);

	Route::post('/settings/{user}/edit', [
		'as' => 'user.edit',
		'uses' => 'UserController@edit'
	]);

  Route::get('/tinker', [
    'as' => 'tinker',
    'uses' => 'HomeController@tinker',
  ]);


  # grade group prefix routes
  Route::group(['prefix' => '{grade}'], function () {
    # student profile
    Route::get('/{id}/profile', [
      'as' => 'student.grade.show',
      'uses' => 'StudentGradeController@show'
    ]);

    Route::get('/{id}/student', [
      'as' => 'singlestudent.grade.show',
      'uses' => 'StudentGradeController@student'
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
