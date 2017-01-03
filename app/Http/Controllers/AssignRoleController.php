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
		$user = User::where('id', $id)->with('grade')->first();

		$slug = $request->class."-".$request->stream;
		$name = $request->class." ".$request->stream;

		$grade = Grade::where('slug', $slug)->with('user')->firstOrFail();

		if ($grade->user) {

			notify()->flash("This class is already assigned to a teacher, choose another class", 'danger');

			return redirect($id.'/edit')
             ->withInput();
		} else {
			if (count($user->grade) != 0) {
					$user->grade->update([
						'user_id' => null,
					]);

					$grade->update([
						'user_id' => $id,
						'name' => $name,
						'slug' => $slug,
					]);
					activity('assign-class')
					->causedBy(Auth::user())
					->performedOn($user->grade)
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
			elseif ($user->hasRole('class_teacher')) {
				notify()->flash($user->name." is already a class teacher , assign another role", 'danger');
				return redirect($id.'/edit')
	             ->withInput();
			} else {
				$user->attachRole('class_teacher');

				$grade->update([
					'user_id' => $id,
					'name' => $name,
					'slug' => $slug,
				]);
				activity('assign-class')
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
		$user = Teacher::where('user_id', $id)->with('user','subject')->first();

		$classslug = $request->class."-".$request->stream;
		$classname = $request->class." ".$request->stream;
		$subjectname = $request->subject;

		$subject = Subject::where('name', $subjectname)->first();
		$grade = Grade::where('slug', $classslug)->first();

		$teacher = Teacher::where([
								['grade_id' ,'=', $grade->id],
								['subject_id' ,'=', $subject->id],
								])->first();

		if ($grade) {
			# Checking if the record is unique through out the teachers table
			if ($teacher->user_id) {
				# Teacher record already exist choose another class
				notify()->flash($teacher->user->name." is already assigned to this class as ".$teacher->subject->name." teacher, choose another class", 'danger');

				return redirect($id.'/edit')
							 ->withInput();
			}else {
				if ($user) {
					# Manuel checkup if this teacher record is does not exist in Teacher table
					# just realized you can teach the same subject but in different class
					if ($user->grade_id != $grade->id) {
						# Check if the new teacher role is checked to add another teacher role to the $user->user
						if (isset($request->update)) {
							# Change the current class or subject of the teacher
							$user->update([
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$classslug,
							]);

							notify()->flash($user->user->name." is  assigned to a class as .' $subjectname '. teacher", 'success');
							return redirect('teachers');
						}else {
							$newUser = Teacher::create([
								'user_id' => $id,
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$classslug,
							]);
							# Theory suggest that is not necessary to add a teacher role to this user since s/he already a teacher
							# $newUser->teacher->attachRole('teacher');

							notify()->flash($newUser->name." is  assigned to a class as .' $subjectname '. teacher", 'success');
							return redirect('teachers');
						}
					}else {
						# Teacher record already exist choose another class
						notify()->flash($user->user->name." is already assigned to this class as .' $subjectname '. teacher, choose another class", 'danger');

						return redirect($id.'/edit')
									 ->withInput();
					}

				}else {
					# This is a new teacher
					$newUser = User::find($id);
					#checking if s/he has a Teacher role
					if ($newUser->hasRole('teacher')) {
							$newUser->teacher()->create([
								'user_id' => $id,
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$classslug,
							]);

							notify()->flash($newUser->name." is  assigned to a class as .' $subjectname '. teacher", 'success');
							return redirect('teachers');

					}else {
						# this user already have a s/he role
						$newUser->teacher()->create([
							'user_id' => $id,
							'grade_id' => $grade->id,
							'subject_id' => $subject->id,
							'slug' => $subject->name."-".$classslug,
						]);
						$newUser->attachRole('teacher');

						notify()->flash($newUser->name." is  assigned to a class as .' $subjectname '. teacher", 'success');
						return redirect('teachers');
					}

				}

			}

		}
		 else {
			# The class chooesed does not have exist yet in grades table
			notify()->flash("This class is not assigned to a class teacher yet, choose another class", 'danger');

			return redirect($id.'/edit')
						 ->withInput();
		}

	}

	public function admin($id)
	{
		$user = User::find($id);
		# check if the user is arleady an admin
		if ($user->hasRole('admin')) {
			# already assigned an administrator role
			notify()->flash($user->name." is already assigned an administrator role, choose another user", 'danger');

			return redirect($id.'/edit')
						 ->withInput();
		}else {
			$user->attachRole('admin');

			activity('attach-admin')
			->causedBy(Auth::user())
			->performedOn($user)
			->log($user->name." Is assigned administrator role by ". Auth::user()->name);

			notify()->flash($user->name." Is assigned administrator role by ". Auth::user()->name, 'success');

			return redirect('teachers');
		}
	}

	public function destroy($id, Request $request)
	{
		# Check what role to delete
		# Check request->delete to delete data
		switch($request->role)
		{
			 case 'teacher':
			 {
				 $teacher = Teacher::where([
					 'slug'=> $request->delete,
					 'user_id' => $id,
				 ])->first();

				 $user = User::find($id);

				if (count($user->user()->where("user_id",$id)->get()) > 1) {
						$teacher->delete();

						activity('deleted-subject-teacher')
				 		->causedBy(Auth::user())
				 		->log("Records has been deleted successful by ". Auth::user()->name);

				 		notify()->flash("Records has been deleted successful by ". Auth::user()->name, 'success');

				 		return redirect('teachers');
				}else {
					$teacher->delete();

					$user->detachRole('teacher');

					activity('detach-teacher-role')
					->causedBy(Auth::user())
					->performedOn($user)
					->log($user->name." Records has been detached successful by ". Auth::user()->name);

					notify()->flash($user->name. "Subject teacher record detached", 'success');

					return redirect('teachers');
				}

			 }
			 case 'class_teacher':
			 {
				 	$user = User::find($id);
					$user->detachRole('class_teacher');

					activity('detach-class_teacher-role')
					->causedBy(Auth::user())
					->performedOn($user)
					->log($user->name." Records has been detached successful by ". Auth::user()->name);

					notify()->flash($user->name. "Class teacher record detached", 'success');

					return redirect('teachers');
			 }
			 case 'admin':
			 {
				 $user = User::find($id);
				 $user->detachRole('admin');

				 activity('detach-admin-role')
				 ->causedBy(Auth::user())
				 ->performedOn($user)
				 ->log($user->name." Records has been detached successful by ". Auth::user()->name);

				 notify()->flash($user->name. "Administrator record detached", 'success');

				 return redirect('teachers');
			 }
			 default:break;
		}
	}

}
