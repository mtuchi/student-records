<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

use App\Http\Requests;
use App\Http\Requests\EditStudentFormRequest;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Score;
use App\Models\Subject;
use App\Models\Attendance;

use PDF;

class StudentController extends Controller
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
			$students = Student::all();
			return view('student.index',['students' => $students]);
    }

		public function create()
		{
			return view('student.create');
		}

		public function edit($id)
		{
			$student = Student::where('id', $id)->with('grade')->firstOrFail();
			return view('student.edit',['student' => $student,'id' => $id]);
		}

		public function show($id)
		{
			$student = Student::where('id', $id)->firstOrFail();
			return view('student.show',['student' => $student,'id' => $id]);
		}

		public function store(EditStudentFormRequest $request)
		{
			$student = Student::create([
				'name' => $request->name,
				'guardian' => $request->guardian,
				'emergency_contact' => $request->phone,
				'gender' => $request->gender,
				'dob' => $request->dob,
			]);

			activity('created-student')
			->causedBy(Auth::user())
			->performedOn($student)
			->withProperties([
			'attributes' => [
				'name' => $request->name,
				'guardian' => $request->guardian,
				'emergency_contact' => $request->phone,
				'gender' => $request->gender,
				'dob' => $request->dob,
			],
			'type' => 'success',
			])
			->log($student->name." Records has been created successful by ". Auth::user()->name);

			notify()->flash($request->name." has been added", 'success');

			return redirect('students');
		}

		public function assign(Request $request, $id)
		{
			$slug = $request->class."-".$request->stream;
			$name = $request->class." ".$request->stream;

			$student = Student::find($id);

			$grade = Grade::where('slug', $slug)->first();

			if ($grade) {
				if ($student->grade->count()) {

					$student->grade()->sync([$grade->id => [ 'student_id' => $id] ], false);
					// $student->grade()->updateExistingPivot($grade->id,['student_id' => $id]);

					notify()->flash($student->name." has been assigned to $grade->name ", 'success');

						// foreach ($student->grade as $grade) {
						// 	notify()->flash($student->name." is already assigned to $grade->name ", 'warning');
						// }
		 		  return redirect('students');

				} else {
					$student->grade()->attach($grade->id);

					notify()->flash($student->name." has been assigned to $grade->name ", 'success');
		 		  return redirect('students');
				}
			} else {
				notify()->flash("The selected class is not assigned to a class teacher yet, choose anothe class", 'danger');
				return redirect('students/'.$id.'/edit')
								->withInput();
			}
		}

		public function update($id, EditStudentFormRequest $request)
		{
			$student = Student::where('id', $id)->first();

			activity('update-teacher')
			->causedBy(Auth::user())
			->performedOn($student)
			->withProperties([
			'attributes' => [
				'name' => $request->name,
				'guardian' => $request->guardian,
				'emergency_contact' => $request->phone,
				'gender' => $request->gender,
				'dob' => $request->dob,
			],
			'old' => [
				'name' => $student->name,
				'guardian' => $student->guardian,
				'emergency_contact' => $student->phone,
				'gender' => $student->gender,
				'dob' => $student->dob,
			],
			'type' => 'success',
			])
			->log($student->name." Records has been updated successful by ". Auth::user()->name);

			$student->update([
				'name' => $request->name,
				'guardian' => $request->guardian,
				'emergency_contact' => $request->phone,
				'gender' => $request->gender,
				'dob' => $request->dob,
		 ]);

		 notify()->flash($student->name." has been updated", 'success');

		 return redirect('students');
		}

		public function destroy($id)
		{
			$student = Student::find($id);
			$student->delete();

			$student->onlyTrashed()->where('id', $id)->first();

			activity('deleted-student')
			->causedBy(Auth::user())
			->performedOn($student)
			->withProperties([
			'attributes' => [
				'name' => $student->name,
				'guardian' => $student->guardian,
				'emergency_contact' => $student->phone,
				'gender' => $student->gender,
				'dob' => $student->dob,
			],
			'type' => 'success',
			])
			->log($student->name." Records has been deleted successful by ". Auth::user()->name);

			notify()->flash($student->name. " record deleted", 'success');

			return redirect('students');
		}
}
