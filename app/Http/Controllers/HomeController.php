<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Subject;
use App\Models\Quarter;
use App\Models\Score;
use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;
use App\Http\Requests\QuarterMonths;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      // $grade = Grade::where('user_id', Auth::user()->id)->first();
      // $teachers = Teacher::where('grade_id', $grade->id)->whereIn('subject_id', json_decode($grade->subjects))->with('subject','teacher')->get();
      // dd($teachers);
      return view('subjects.subject');
    }

    public function indexEdit(Request $request, Subject $subject)
    {
      $student_id = $request->route()->id;
      $quarter_slug = $request->route()->quarter;
      $quarter = Quarter::isLive()->where('slug', $quarter_slug)->first();

      $user = Auth::user()->username;

      $score = Score::with('student','quarter')->where('student_id', $student_id)->where('quarter_id', $quarter->id)->first();

      return view('quarters.edit',[
        'user' => $user,
        'subject' => $subject,
        'score' => $score
      ]);
    }

    public function edit($subject,$quarter, $id, QuarterMonths $request)
    {
      $score = Score::where('subject_id', Subject::where('slug', $subject)->pluck('id'))
              ->where('quarter_id', Quarter::isLive()->where('slug', $quarter)->pluck('id'))
              ->where('student_id', $id)->first();

      $score->update([
        'first_month' => $request->first_month_score,
        'second_month' => $request->second_month_score,
        'third_month' => $request->third_month_score,
      ]);

      return redirect()->route('user.subject',$subject);
    }

    /**
     * Show the users quaters data.
     *
     * @return \Illuminate\Http\Response
     */
    public function quarter()
    {
      $subject = Auth::user()->subjects()->with('subject')->first();
      $user = Auth::user()->username;
      
      return view('quarters.quarter', [
        'user' => $user,
        'subject' => $subject->subject
      ]);
    }

    public function tinker(Subject $subject)
    {
      $collections = Quarter::with('score.student')->isLive()->get();
      // Convert each member of the returned collection into an array,
      // and append it to the payments array.
      $collectionArr = [];
      $subjectName = $subject->name;
      $teacherName = Auth::user()->name;
      $scores = [];
      foreach ($collections as $collection)
      {
          $collectionArr[] = $collection->toArray();
      }

      dd($collectionArr);
      // Generate and return the spreadsheet
      Excel::create('grades', function($excel) use ($collectionArr, $subjectName, $teacherName) {

          // Set the spreadsheet title, creator, and description
          $excel->setTitle($subjectName);
          $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
          $excel->setDescription('Student Quarterly grades');

          // Build the spreadsheet, passing in the collectionArr array
          foreach ($collectionArr as $collection)
          {
            $excel->sheet($collection['name'], function($sheet) use ($collection) {

              foreach ($collection['score'] as $scoreCollection)
              {
                $scores [] = [
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                  'First Month' => $scoreCollection['first_month'],
                  'Second Month' => $scoreCollection['second_month'],
                  'Third Month' => $scoreCollection['third_month'],
                ];
              }
                $sheet->fromArray($scores, null, 'A1', false, true);
            });
          }


      })->download('xlsx');

      dd($scores);

    }

    public function tinkerIndex(Subject $subject)
    {
      return view('tinker',[
        'subject' => $subject
      ]);
    }
    public function tinkerUpload(Request $request, Subject $subject)
    {
      $file = $request->file('sheet');

      $SheetCollection = Excel::load($file)->ignoreEmpty();
      dd($SheetCollection->PHPExcel);
      $rowCollection = $SheetCollection->all();
      $cellCollection = [];
      $Arr = [];
      foreach ($rowCollection as $collection)
      {
        foreach ($collection as $cell)
        {
          if (!empty($cell['student_id']) && !empty($cell['name']) && !empty($cell['first_month']))
          {
            $score = Score::where('subject_id', $subject->id)->where('quarter_id', $cell['quarter_id'])
            ->where('student_id', $cell['student_id'])->first();

            $score->update([
              'first_month' => $cell['first_month'],
              'second_month' => $cell['second_month'],
              'third_month' => $cell['third_month']
            ]);
            $cellCollection [] = $cell->toArray();
          }
        }
      }
      dd($cellCollection);

    }

}
