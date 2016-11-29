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
            return Score::where('student_id', $id)->where('subject_id', Auth::user()->subjects->first()->subject_id)
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

      public function update(Request $request)
      {
        return view('settings.edit.profile');
      }
}
