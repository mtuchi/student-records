<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Grade;
use App\Models\Score;
use App\Models\Teacher;
use App\Http\Requests\QuarterFormRequest;
use App\Http\Requests\MonthFormRequest;

use Notify;

class ExcelController extends Controller
{
  public function index($class, $subject)
  {
    $details = Auth::user()->subjects()->with('subject')->first();

    return view('subjects.upload',[
      'subject' => $details,
      'grade' => $class
    ]);
  }

  public function show($class, $subject)
  {
    $subject = Auth::user()->subjects()->with('subject')->first();
    $grade =  Grade::where('slug', $class)->first();
    $quarters = Quarter::isLive()->get();

    return view('subjects.export', [
      'subject' => $subject,
      'grade' => $grade,
      'quarters' => $quarters
    ]);
  }

  public function upload($class, $subject, Request $request)
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
        foreach ($collection as $key => $cell)
        {

          if (!empty($cell['student_id']) && !empty($cell['name']) && !empty($cell['first_month']))
          {
            $score = Score::where('subject_id', $subject_id)->where('quarter_id', $id)
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
      notify()->flash('You have success full uploaded the scores for '.$urltitle.' To see the changes checkout activity logs', 'success',['timer' => 5000]);

      return redirect()->route('quarter.show',[$class, $subject]);

    }else {
      notify()->flash('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle, 'danger',['timer' => 5000]);

      return redirect()->back();
    }

  }

  public function all($class, $subject)
  {
    $id = Subject::where('name', $subject)->pluck('id')->first();

    $collections = Quarter::isLive()->with(['score' => function ($query) use($id) {
        $query->with('student')->where('subject_id', $id);
    }])->get();


    /*
      Convert each member of the returned collection into an array,
      and append it to the payments array.
      where would i need this
      # $user = Auth::user()->subjects()->with('subject')->first();
    */


    $collectionArr = [];
    $title = $subject."-". $class;
    $teacherName = Auth::user()->name;
    $scores = [];
    foreach ($collections as $collection)
    {
      $collectionArr[] = $collection->toArray();
    }

    if (count($collection->score))
    {
      # Generate and return the spreadsheet
      Excel::create($title, function($excel) use ($collectionArr, $title, $teacherName)
      {
        # Set the spreadsheet title, creator, and description
        $excel->setTitle($title);
        $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
        $excel->setDescription('Student Quarterly grades');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($collectionArr as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['score']))
            {
              foreach ($collection['score'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['student_id'],
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                  'First Month' => $scoreCollection['first_month'],
                  'Second Month' => $scoreCollection['second_month'],
                  'Third Month' => $scoreCollection['third_month'],
                ];
              }

              $sheet->fromArray($scores, null, 'A1', false, true);
            }
          });
        }
      })->export('xlsx');

    }else {
      $studentList = Grade::where('slug', $class)->pluck('students')->first();
      $students = Student::whereIn('id', json_decode($studentList))->get();

      dd($students);
    }

  }

  public function quarter($class, $subject, QuarterFormRequest $request)
  {
    if ($request->ajax())
    {
      print_r($request);die;
    }
    $id = Subject::where('name', $subject)->pluck('id')->first();

    $collections = Quarter::isLive()->whereIn('id', $request->quarters)->with(['score' => function ($query) use($id) {
        $query->with('student')->where('subject_id', $id);
    }])->get();


    /*
      Convert each member of the returned collection into an array,
      and append it to the payments array.
      where would i need this
      # $user = Auth::user()->subjects()->with('subject')->first();
    */


    $collectionArr = [];
    $title = $subject."-". $class;
    $teacherName = Auth::user()->name;
    $scores = [];
    foreach ($collections as $collection)
    {
      $collectionArr[] = $collection->toArray();
    }

    if (count($collection->score))
    {
      # Generate and return the spreadsheet
      Excel::create($title, function($excel) use ($collectionArr, $title, $teacherName)
      {
        # Set the spreadsheet title, creator, and description
        $excel->setTitle($title);
        $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
        $excel->setDescription('Student Quarterly grades');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($collectionArr as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['score']))
            {
              foreach ($collection['score'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['student_id'],
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                  'First Month' => $scoreCollection['first_month'],
                  'Second Month' => $scoreCollection['second_month'],
                  'Third Month' => $scoreCollection['third_month'],
                ];
              }

              $sheet->fromArray($scores, null, 'A1', false, true);
            }
          });
        }
      })->export('xlsx');

    }else {
      $studentList = Grade::where('slug', $class)->pluck('students')->first();
      $students = Student::whereIn('id', json_decode($studentList))->get();

      dd($students);
    }

    return response()->json($request);
  }

  public function month($class, $subject, MonthFormRequest $request)
  {
    return response()->json($request);
  }

  public function back()
  {
    return redirect()->back();
  }
}
