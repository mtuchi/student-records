<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditTeacherFormRequest;

use App\Models\User;
use App\Models\Grade;

use Auth;

class AssaignTeacherController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
			$this->middleware('auth');
	}

	public function show($id)
	{
		$user = User::where('id', $id)->firstOrFail();
		return view('teacher.assaign',['user' => $user,'id' => $id]);
	}

	public function edit($id, Request $request)
	{
		$user = User::where('id', $id)->first();

		$slug = $request->class."-".$request->stream;
		$name = $request->class." ".$request->stream;

		$grade = Grade::where('slug', $slug)->count();

		if ($grade) {

			notify()->flash("This class is already assaigned to a teacher, choose another class", 'danger');

			return redirect($id.'/assaign')
                        ->withInput();
		} else {

			if ($user->hasRole('class_teacher')) {
				notify()->flash($user->name." is already a class teacher , assaign another role", 'danger');
				return redirect($id.'/assaign')
	                        ->withInput();
			} else {
				$user->makeTeacher('class_teacher');

				Grade::create([
					'user_id' => $id,
					'name' => $name,
					'slug' => $slug,
				]);

				activity('assaign-teacher')
				->causedBy(Auth::user())
				->performedOn($user)
				->withProperties([
				'attributes' => [
					'name' => $name,
					'slug' => $slug,
				],
				'type' => 'success',
				])
				->log($user->name." Class teacher role has been assaigned successfull by ". Auth::user()->name);

				notify()->flash($user->name." class teacher role has been assaigned successfull", 'success');

				return redirect('teacherlist');
			}

		}

	}
}
