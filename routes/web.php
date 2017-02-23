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

Route::group(['middleware' => 'role:admin'], function(){
	Route::get('/admin',function(Illuminate\Http\Request $request){
		return "admin panel";
	});
	Route::group(['middleware' => 'role:admin,revoke user'], function(){
		Route::get('/admin/users', function(){
			return "Delete Users";
		});
	});
});

Route::get('/welcome', function (Illuminate\Http\Request $request) {
    $user = $request->user();
		// dump($user->hasRole('admin','teacher'));
		// dd($user->can('delete post'));

		// $user->withDrawPermissionTo(['delete post','edit post']);
		$user->refreshPermissions(['delete post','edit post']);
    // return view('welcome');

		return new \Illuminate\Http\Response('hello', 200);
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
  # subjects CRUD
  Route::resource('subjects', 'SubjectsController');
  # group prefix for grades
  Route::group(['prefix' => '/grades'], function(){
    Route::get('/', 'GradeController@index');

		#add grade
		Route::get('/create', 'GradeController@create');

		# store grade
		Route::post('/','GradeController@store');


		#prefix with grade id
		Route::group(['prefix' => '{slug}'], function(){
			#show grade
			Route::get('/', [
				'as' => 'grade.show',
				'uses' => 'GradeController@show'
			]);
			#show edit
			Route::get('/edit', [
				'as' => 'grade.edit',
				'uses' => 'GradeController@edit'
			]);
			# save updates
			Route::put('/', [
				'as' => 'grade.update',
				'uses' => 'GradeController@update'
			]);
			#destroy record
			Route::delete('/', [
				'as' => 'grade.destroy',
				'uses' => 'GradeController@destroy'
			]);

		});
  });
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

			# assign student to class
			Route::post('/', [
				'as' => 'student.assign',
				'uses' => 'StudentController@assign'
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

	# group prefix for teachers
	Route::group(['prefix' => 'teachers'], function(){
		#get teacher list
		Route::get('/', 'TeacherController@index');
		#add teacher
	  Route::get('/create', 'TeacherController@create');
		# store teacher
		Route::post('/create','TeacherController@store');
	});


  #assign class teacher role
	Route::post('/{id}/class', [
		'as' => 'assignclass.update',
		'uses' =>'AssignRole\ClassTeacherController@update'
		]);

  # delete class teacher
  Route::delete('/{id}/class', [
		'as' => 'assignclass.destroy',
		'uses' => 'AssignRole\ClassTeacherController@destroy'
	]);
	#assign teacher role
	Route::post('/{id}/teacher', [
		'as' => 'assignteacher.update',
		'uses' =>'AssignRole\TeacherController@update'
		]);
	# delete assign teacher
  Route::delete('/{id}/teacher', [
		'as' => 'assignteacher.destroy',
		'uses' => 'AssignRole\TeacherController@destroy'
	]);

	#assign admin role
	Route::post('/{id}/admin', [
		'as' => 'assignadmin.update',
		'uses' =>'AssignRole\AdminController@update'
		]);
  # delete assign teacher
  Route::delete('/{id}/admin', [
		'as' => 'assignadmin.destroy',
		'uses' => 'AssignRole\AdminController@destroy'
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

	Route::get('/pdf', [
		'as' => 'pdf.print',
		'uses' => 'StudentGradeController@print'
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
	Route::resource('export', 'ExportAttendanceController');
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
         'as' => 'score.quarter',
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
    Route::post('/',[
      'as' => 'grade.back',
      function () {
        return redirect()->back();
      }
    ]);

	# attendance routes
	# get attendance scores
	 Route::get('/',[
	   'as' => 'attendance.quarter',
	   'uses' => 'AttendanceController@quarter'
	 ]);

	Route::group(['prefix' => '{quarter}'], function(){
		// Editing  student attendance
	    Route::get('/{id}/edit', [
	      'as' => 'attendance.show',
	      'uses' => 'AttendanceController@show'
	    ]);

	    Route::post('/{id}/edit', [
	      'as' => 'attendance.update',
	      'uses' => 'AttendanceController@update'
	    ]);
	});


  });

});
