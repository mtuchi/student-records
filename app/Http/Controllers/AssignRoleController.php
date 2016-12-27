<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditTeacherFormRequest;

use App\Models\User;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

use Auth;

class AssignRoleController extends Controller
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

	public function class($id, Request $request)
	{
		$user = User::where('id', $id)->first();

		$slug = $request->class."-".$request->stream;
		$name = $request->class." ".$request->stream;

		$grade = Grade::where('slug', $slug)->count();

		if ($grade) {

			notify()->flash("This class is already assigned to a teacher, choose another class", 'danger');

			return redirect($id.'/edit')
             ->withInput();
		} else {

			if ($user->hasRole('class_teacher')) {
				notify()->flash($user->name." is already a class teacher , assign another role", 'danger');
				return redirect($id.'/edit')
	             ->withInput();
			} else {
				$user->makeTeacher('class_teacher');

				Grade::create([
					'user_id' => $id,
					'name' => $name,
					'slug' => $slug,
				]);

				activity('assign-teacher')
				->causedBy(Auth::user())
				->performedOn($user)
				->withProperties([
				'attributes' => [
					'name' => $name,
					'slug' => $slug,
				],
				'type' => 'success',
				])
				->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

				notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

				return redirect('teachers');
			}

		}

	}

	public function teacher($id, Request $request)
	{
		$user = Teacher::where('user_id', $id)->with('teacher','subject')->first();

		$classslug = $request->class."-".$request->stream;
		$classname = $request->class." ".$request->stream;
		$subjectname = $request->subject;

		$subject = Subject::where('name', $subjectname)->first();
		$grade = Grade::where('slug', $classslug)->first();

		if ($grade) {
			if ($user) {
					$user->update([
						'grade_id' => $grade->id,
						'subject_id' => $subject->id,
						'slug' => $subject->name."-".$classslug,
					]);
					$user->teacher->makeTeacher('teacher');
					notify()->flash($user->teacher->name." is assigned to a class as .' $subjectname '. teacher", 'success');

				return redirect($id.'/edit')
							 ->withInput();
			}else {
				$newUser = Teacher::create([
					'user_id' => $id,
					'grade_id' => $grade->id,
					'subject_id' => $subject->id,
					'slug' => $subject->name."-".$classslug,
				]);
				$newUser->teacher->makeTeacher('teacher');

				notify()->flash($newUser->name." is  assigned to a class as .' $subjectname '. teacher", 'success');
			}
		}else {
			notify()->flash("This class is not assigned to a class teacher yet, choose another class", 'danger');

			return redirect($id.'/edit')
						 ->withInput();
		}


	}

}
