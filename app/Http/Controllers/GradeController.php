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
		$grades = Grade::with('user')->get();
		// dd($grades);
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

  public function show($slug)
  {
		$grade = Grade::where('slug', $slug)->firstOrFail();
		$students = Student::whereHas('grade', function($q) use($grade){
			$q->where('id', $grade->id);
		})->get();

		$subjects = Subject::whereHas('grade', function($q) use($grade){
			$q->where('id', $grade->id);
		})->get();


		return view('grade.show',[
			'grade' => $grade,
			'slug' => $slug,
			'students' => $students,
			'subjects' => $subjects
		]);
  }
}
