<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Score;
use App\Models\Subject;
use App\Models\Attendance;

use PDF;
use Auth;

class StudentGradeController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
		 public function show($class, $id)
			{
				$student = Student::where('id', $id)->with('grade')->first();
				$grade = Grade::where('slug', $class)->first();
				$subject = Subject::get();


				$scores = function() use($id, $subject) {
					if (Auth::user()->hasRole('class_teacher')) {
						return Score::where('student_id', $id)->with('subject','quarter.months')->get()->groupBy(function($key, $item) use($subject){
						 return $subject->where('id', $key['subject_id'])->pluck('name')->first();
					 });
					}
					if (Auth::user()->hasRole('teacher')) {
						return Score::where('student_id', $id)->where('subject_id', Auth::user()->subjects->first()->subject_id)
						->with('subject','quarter.months')->get()->groupBy(function($key, $item) use($subject){
						 return $subject->where('id', $key['subject_id'])->pluck('name')->first();
					 });
					}
				};

				$attendance = Attendance::where('student_id', $id)->with('grade','quarter.months')->get()->groupBy(function($key, $item) use($grade){
					return $grade->where('id', $key['grade_id'])->pluck('name')->first();
				});


				return view('settings.student.profile',[
					'student' => $student,
					'scores' => $scores(),
					'attendance' => $attendance
				]);
			}

			public function student($class, $id)
			{
				$student = Student::where('id', $id)->first();
				$grade = Grade::where('slug', $class)->first();
				$subject = Subject::get();


				$scores = function() use($id, $subject) {
					if (Auth::user()->hasRole('class_teacher')) {
						return Score::where('student_id', $id)->with('subject','quarter.months')->get()->groupBy(function($key, $item) use($subject){
						 return $subject->where('id', $key['subject_id'])->pluck('name')->first();
					 });
					}
					if (Auth::user()->hasRole('teacher')) {
						return Score::where('student_id', $id)->where('subject_id', Auth::user()->teacher->first()->subject_id)
						->with('subject','quarter.months')->get()->groupBy(function($key, $item) use($subject){
						 return $subject->where('id', $key['subject_id'])->pluck('name')->first();
					 });
					}
				};

				return view('settings.student.single',[
					'student' => $student,
					'scores' => $scores(),
				]);
			}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

		public function print()
		{
			$data = ['Sanaa Tuu'];
			$pdf = PDF::loadView('settings.print.sample');
			return $pdf->download('invoice.pdf');
		}
}
