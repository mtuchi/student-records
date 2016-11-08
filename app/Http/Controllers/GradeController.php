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

  public function show($grade)
  {
    // $this->authorize('view', $grade);
    $id = Grade::where('slug', $grade)->pluck('id')->first();
    $grade = Grade::where('user_id', Auth::user()->id)->first();
    $user = Auth::user()->username;
    $quarters = Quarter::isLive()->with(['attendance' => function ($query) use($id) {
        $query->where('grade_id', $id);
    }])->get();

    $students = Student::whereIn('id', json_decode($grade->students))->get();
    return view('quarters.attendance', [
      'user' => $user,
      'grade' => $grade,
      'quarters' => $quarters,
      'students' => $students
    ]);
  }
}
