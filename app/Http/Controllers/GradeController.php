<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\QuarterMonths;
use App\Http\Requests;

use App\Models\Subject;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Score;
use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;

class GradeController extends Controller
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

	public function index()
	{
		$grades = Grade::with(['user','subject','student'])->get();
		return view('grade.index',['grades' => $grades]);
	}

	public function create()
	{
		$users = User::whereDoesntHave('roles', function($q){
			$q->where('name', 'class_teacher');
		})->get();

		return view('grade.create', compact('users'));
	}

	public function store(Request $request)
	{
		$name = $request->class." ".$request->stream;
		$slug = $request->class."-".$request->stream;
		$user_id = $request->teacher;

		$grade = Grade::where('slug', $slug)->first();

		if ($grade) {
			notify()->flash($grade->name." Already exist ,enter another grade or change this grade class teacher", 'danger');

			return redirect('grades/create')
						 ->withInput();
		}else {

			$newGrade = Grade::create([
				'name' => $name,
				'slug' => $slug,
				'user_id' => $user_id,
			]);

			activity('created-grade')
			->causedBy(Auth::user())
			->performedOn($newGrade)
			->withProperties([
			'attributes' => [
				'name' => $name,
				'slug' => $slug,
				'user_id' => $user_id,
			],
			'type' => 'success',
			])
			->log($name." Grade has been created successful by ". Auth::user()->name);

			notify()->flash($name." has been added successfull", 'success');

			return redirect('grades');
		}

	}

	public function edit($slug)
	{
		$grade = Grade::where('slug', $slug)->with('user')->first();
		$users = User::whereDoesntHave('roles', function($q){
			$q->where('name', 'class_teacher');
		})->get();

		return view('grade.edit',['grade' => $grade,'users'=>$users, 'slug' => $slug]);
	}

	public function update($slug,Request $request)
	{
		$user = User::where('id', $request->teacher)->with('grade')->first();
		$grade = Grade::where('slug', $slug)->with('user')->first();

		# check if class has class teacher
		if ($grade->user) {
				# remove teacher role for this user
				$grade->user->detachRole('class_teacher');

				activity('detach-class_teacher-role')
				->causedBy(Auth::user())
				->performedOn($grade->user)
				->log($grade->user->name." Records has been detached successful by ". Auth::user()->name);

				notify()->flash($grade->user->name." Records has been detached successful by ".Auth::user()->name, 'success');

				# delete user in grade table
				$grade->update([
					'user_id' => $request->teacher
				]);
				# assign class_teacher role to the new user
				// $user->grade->update([
				// 	'user_id' => $request->id
				// ]);

				// activity('assign-class')
				// ->causedBy(Auth::user())
				// ->performedOn($user->grade)
				// ->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);
				//
				// notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

				return redirect('teachers');

		}else {
			# check if user is arleady a class teacher
			if ($user->hasRole('class_teacher')) {
				# assign class_teacher role to the new user in grade table
				$user->grade->update([
					'user_id' => $request->teacher
				]);

				activity('assign-class')
				->causedBy(Auth::user())
				->performedOn($user->grade)
				->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

				notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

				return redirect('teachers');
			}else {
				# attach class_teacher role
				$user->attachRole('class_teacher');
				# assign class_teacher role to the new user in grade table
				dd($user->grade);
				if ($user->grade) {
					# code...
				}
				$user->grade->update([
					'user_id' => $request->teacher
				]);

				activity('assign-class')
				->causedBy(Auth::user())
				->performedOn($user->grade)
				->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

				notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

				return redirect('teachers');
			}

		}

	}

  public function show($slug)
  {
		$grade = Grade::where('slug', $slug)->with('student','subject','teacher')->first();

		return view('grade.show',[
			'grade' => $grade,
			'slug' => $slug,
		]);
  }
}
