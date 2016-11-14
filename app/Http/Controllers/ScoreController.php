<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

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
use App\Models\Month;

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
    },'months'])->get();

    $grade = Grade::where('slug', $grade)->first();

    $students = Student::whereIn('id', json_decode($grade->students))->get();

    return view('quarters.score.index', [
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

    return view('quarters.score.edit',[
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

  public function showupload($class, $subject)
  {
    $details = Auth::user()->subjects()->with('subject')->first();

    return view('quarters.score.upload',[
      'subject' => $details,
      'grade' => $class
    ]);
  }

  public function storeupload($class, $subject, Request $request)
  {
    $file = $request->file('sheet');
    $subject_id = Subject::where('name', $subject)->pluck('id')->first();
    $user = Auth::user()->subjects()->with('subject')->first();

    $SheetCollection = Excel::load($file)->ignoreEmpty();
    $rowCollection = $SheetCollection->all();
    # A very unsecured way for quick validation
    $urltitle = $subject."-".$class;

    if ($urltitle == $rowCollection->getTitle())
    {
      $cellCollection = [];
      $Arr = [];
      foreach ($rowCollection as $collection)
      {
        $id = Quarter::where('name', $collection->getTitle())->pluck('id')->first();
        $months = Month::where('quarter_id', $id)->get();
        $options = ['options' => ['min_range' => 0,'max_range' => 100,]];
        $filtered = $collection->filter(function ($value, $key) use($months,$options) {
          foreach ($months as $month)
          {
            if (filter_var(trim($value[strtolower($month['name'])]), FILTER_VALIDATE_INT, $options) !== FALSE) {
                return $value;
            } else {
                notify()->flash('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle.'
                and you don\'t have any invalid charcters in your excel sheet', 'danger',['timer' => 5000]);

                return redirect()->back();
            }
          }
        });


        foreach ($filtered as $key => $cell)
        {

          if (!empty($cell['student_id']) && !empty($cell['name']) && !empty($cell[strtolower($months[0]['name'])]))
          {
            $score = Score::where('subject_id', $subject_id)->where('quarter_id', $id)
            ->where('student_id', $cell['student_id'])->first();

            $score->update([
              'first_month' => $cell[strtolower($months[0]['name'])],
              'second_month' => $cell[strtolower($months[1]['name'])],
              'third_month' => $cell[strtolower($months[2]['name'])]
            ]);
            $cellCollection [] = $cell->toArray();
          }
        }
      }
      notify()->flash('You have success full uploaded the scores for '.$urltitle.' To see the changes checkout activity logs', 'success',['timer' => 5000]);

      return redirect()->route('quarter.show',[$class, $subject]);

    }else {
      notify()->flash('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle, 'danger',['timer' => 5000]);

      return redirect()->back();
    }

  }
}
