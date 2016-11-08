<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\Http\Requests;
use App\Http\Requests\QuarterMonths;

use App\Models\Subject;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Score;
use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;

use Notify;

class ScoreController extends Controller
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
   * Show the users quaters data.
   *
   * @return \Illuminate\Http\Response
   */
  public function show($grade, $subject)
  {
    /*
      I have learn alot today 3 Nov 016,
      About how touse groupBy in eloquent Models
      and how to use with (Constraining Eager Loads. ie from documentation)
      It made query and structuring the data really easy
      groupBy expample.
      $id = Subject::where('name', $subject)->pluck('id')->first();
      $scores = $score->where('subject_id', $id)->with('student','quarter')->get();
      $temp = $score->groupBy('quarter_id');
    */
    // $this->authorize('view', $quarter);

    $id = Subject::where('name', $subject)->pluck('id')->first();
    # $userSubject = Auth::user()->subjects()->with('subject')->first();
    $user = Auth::user()->username;

    $quarters = Quarter::isLive()->with(['score' => function ($query) use($id) {
        $query->where('subject_id', $id);
    }])->get();

    $grade = Grade::where('slug', $grade)->first();

    $students = Student::whereIn('id', json_decode($grade->students))->get();

    return view('quarters.quarter', [
      'user' => $user,
      'subject' => $subject,
      'quarters' => $quarters,
      'students' => $students,
      'grade' => $grade
    ]);
  }

  public function edit($grade, $subject, $quarter, $id)
  {
    $getQuarter = Quarter::isLive()->where('slug', $quarter)->first();

    $user = Auth::user()->username;

    $score = Score::with('student','quarter')->where('student_id', $id)->where('quarter_id', $getQuarter->id)->first();

    return view('quarters.edit',[
      'user' => $user,
      'subject' => $subject,
      'quarter_slug' => $quarter,
      'score' => $score,
      'grade' => $grade
    ]);
  }

  public function update($grade, $subject, $quarter, $id, QuarterMonths $request)
  {
    $getSubject = Subject::where('name', $subject)->first();
    $getStudent = Student::where('id', $id)->first();

    $score = Score::where('subject_id', $getSubject->id)
            ->where('quarter_id', Quarter::isLive()
            ->where('slug', $quarter)->pluck('id'))
            ->where('student_id', $id)->first();

    $score->update([
      'first_month' => $request->first_month,
      'second_month' => $request->second_month,
      'third_month' => $request->third_month,
    ]);

    notify()->flash($getStudent->name." Scores has been updated", 'success');

    return redirect()->route('quarter.show',[$grade, $getSubject->name]);
  }
}
