<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

use App\Http\Requests;

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
			$student = Student::where('id', $id)->firstOrFail();
			return view('student.edit',['student' => $student,'id' => $id]);
		}

		public function show($id)
		{
			$student = Student::where('id', $id)->firstOrFail();
			return view('student.show',['student' => $student,'id' => $id]);
		}
}
