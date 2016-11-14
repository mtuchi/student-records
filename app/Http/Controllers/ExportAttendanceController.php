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
use App\Models\Month;
use App\Models\Attendance;

use App\Http\Requests\QuarterFormRequest;
use App\Http\Requests\MonthFormRequest;

use Notify;

class ExportAttendanceController extends Controller
{

  public function show($class)
  {
    $grade =  Grade::where('slug', $class)->first();
    return view('quarters.attendance.export', [
      'grade' => $grade
    ]);
  }

  public function all($class)
  {
    $id = Grade::where('slug', $class)->pluck('id')->first();

    $collections = Quarter::isLive()->with(['attendance' => function ($query) use($id) {
        $query->with('student')->where('grade_id', $id);
    },'months'])->get();


    $collectionArr = [];
    $title = $class;
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
        $excel->setDescription('Student Quarterly Attendance');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($collectionArr as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['attendance']))
            {
              foreach ($collection['attendance'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['student_id'],
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                   $collection['months'][0]['name'] => $scoreCollection['first_month'],
                   $collection['months'][1]['name'] => $scoreCollection['second_month'],
                   $collection['months'][2]['name'] => $scoreCollection['third_month'],
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

      $quarters = Quarter::isLive()->get();

      $coll = [];

      foreach ($quarters as $value)
      {
        $coll[] = collect($value)->merge(['score' => $students])->toArray();
      }

      # Generate and return the spreadsheet
      Excel::create($title, function($excel) use ($coll, $title, $teacherName, $class)
      {
        # Set the spreadsheet title, creator, and description
        $excel->setTitle($title);
        $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
        $excel->setDescription('Student Quarterly Attendance');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($coll as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['attendance']))
            {

              foreach ($collection['attendance'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['id'],
                  'Name' => $scoreCollection['name'],
                  'Sex' => $scoreCollection['gender'],
                   $collection['months'][0]['name'] => null,
                   $collection['months'][1]['name'] => null,
                   $collection['months'][2]['name'] => null,
                ];
              }

              $sheet->fromArray($scores, null, 'A1', false, true);
            }
          });
        }
        notify()->flash('You have success full exported the excel for '.$title.' To see the changes checkout activity logs', 'success',['timer' => 5000]);

        return redirect()->route('attendance.show',[$class]);

      })->export('xlsx');
    }

  }

  public function quarter($class, QuarterFormRequest $request)
  {
    $id = Grade::where('slug', $class)->pluck('id')->first();

    $collections = Quarter::isLive()->whereIn('id', $request->quarters)->with(['attendance' => function ($query) use($id) {
        $query->with('student')->where('grade_id', $id);
    },'months'])->get();

    $collectionArr = [];
    $title = $class;
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
        $excel->setDescription('Student Quarterly Attendance');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($collectionArr as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['attendance']))
            {
              foreach ($collection['attendance'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['student_id'],
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                  $collection['months'][0]['name'] => $scoreCollection['first_month'],
                  $collection['months'][1]['name'] => $scoreCollection['second_month'],
                  $collection['months'][2]['name'] => $scoreCollection['third_month'],
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

      $quarters = Quarter::isLive()->with('months')->whereIn('id', $request->quarters)->get();

      $coll = [];

      foreach ($quarters as $value)
      {
        $coll[] = collect($value)->merge(['score' => $students])->toArray();
      }

      # Generate and return the spreadsheet
      Excel::create($title, function($excel) use ($coll, $title, $teacherName, $class)
      {
        # Set the spreadsheet title, creator, and description
        $excel->setTitle($title);
        $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
        $excel->setDescription('Student Quarterly grades');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($coll as $collection)
        {
          $excel->sheet($collection['name'], function($sheet) use ($collection)
          {
            if (!empty($collection['attendance']))
            {

              foreach ($collection['attendance'] as $scoreCollection)
              {
                $scores [] = [
                  'Student ID' => $scoreCollection['id'],
                  'Name' => $scoreCollection['name'],
                  'Sex' => $scoreCollection['gender'],
                  $collection['months'][0]['name'] => null,
                  $collection['months'][1]['name'] => null,
                  $collection['months'][2]['name'] => null,
                ];
              }

              $sheet->fromArray($scores, null, 'A1', false, true);
            }
          });
        }
        notify()->flash('You have success full exported the excel for '.$title.' To see the changes checkout activity logs', 'success',['timer' => 5000]);

        return redirect()->route('attendance.show',[$class]);

      })->export('xlsx');


    }

  }

  public function month($class, MonthFormRequest $request)
  {
    $id = Subject::where('name', $subject)->pluck('id')->first();
    $monthsId = $request->months;

    $collections = Quarter::isLive()->with(['months' => function($q) use($monthsId){
      $q->whereIn('id', $monthsId);
    },'score' => function ($query) use($id) {
        $query->with('student')->where('subject_id', $id);
    }])->get();


    foreach ($monthsId as $value) {
        $monthScore = function() use($value)
        {
          if ($value <= 3)
          {
            // return 'first_month';
            return Score::with('students')->pluck('first_month')->groupBy('first_month');
          }
          if ($value >= 4 || $value <= 6)
          {
            // return 'second_month';
            return Score::with('students')->pluck('second_month');

          }
          if ($value >= 7 || $value <= 9)
          {
            // return 'third_month';
            return Score::with('students')->pluck('third_month');

          }
          if ($value >= 10 || $value <= 12)
          {
            // return 'fourth_month';
            return Score::with('students')->pluck('fourth_month');

          }
        };
      }

    // dd($monthScore());

    $collectionArr = [];
    $title = $class;
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
          // dd($collection);
          foreach ($collection['months'] as $value)
          {
            $monthScore = function() use($value)
            {
              if ($value['id'] <= 3)
              {
                return 'first_month';
              }
              if ($value['id'] >= 4 ||$value['id'] <= 6)
              {
                return 'second_month';
              }
              if ($value['id'] >= 7 || $value['id'] <= 9)
              {
                return 'third_month';
              }
              if ($value['id'] >= 10 || $value['id'] <= 12)
              {
                return 'fourth_month';
              }
            };
            dd($collectionArr);

            $excel->sheet($value['name'], function($sheet) use ($collection, $monthScore)
            {
              if (!empty($collection['attendance']))
              {
                foreach ($collection['attendance'] as $scoreCollection)
                {
                  // dd($scoreCollection);
                  $scores [] = [
                    'Student ID' => $scoreCollection['student_id'],
                    'Name' => $scoreCollection['student']['name'],
                    'Sex' => $scoreCollection['student']['gender'],
                    'Score' => $scoreCollection[$monthScore()]
                  ];
                }

                $sheet->fromArray($scores, null, 'A1', false, true);
              }
            });
          }
        }
      })->export('xlsx');

    }else {
      $studentList = Grade::where('slug', $class)->pluck('students')->first();
      $students = Student::whereIn('id', json_decode($studentList))->get();

      $monthsRecord = Quarter::isLive()->with(['months' => function($q) use($monthsId){
          $q->whereIn('id', $monthsId);
        },'score' => function ($query) use($id) {
            $query->with('student')->where('subject_id', $id);
        }])->get();

      $coll = [];

      foreach ($monthsRecord as $value)
      {
        $coll[] = collect($value)->merge(['score' => $students])->toArray();
      }

      # Generate and return the spreadsheet
      Excel::create($title, function($excel) use ($coll, $title, $teacherName, $class, $subject)
      {
        # Set the spreadsheet title, creator, and description
        $excel->setTitle($title);
        $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
        $excel->setDescription('Student Quarterly grades');

        # Build the spreadsheet, passing in the collectionArr array
        foreach ($coll as $collection)
        {
          foreach ($collection['months'] as $value)
          {
            $excel->sheet($value['name'], function($sheet) use ($collection)
            {
              if (!empty($collection['attendance']))
              {

                foreach ($collection['attendance'] as $scoreCollection)
                {
                  $scores [] = [
                    'Student ID' => $scoreCollection['id'],
                    'Name' => $scoreCollection['name'],
                    'Sex' => $scoreCollection['gender'],
                    'Scores' => null
                  ];
                }

                $sheet->fromArray($scores, null, 'A1', false, true);
              }
            });
          }

        }
        notify()->flash('You have success full exported the excel for '.$title.' To see the changes checkout activity logs', 'success',['timer' => 5000]);

        return redirect()->route('attendance.show',[$class]);

      })->export('xlsx');


    }
    return response()->json($request);
  }

  public function back()
  {
    return redirect()->back();
  }
}
