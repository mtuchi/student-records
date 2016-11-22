<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;


use App\Http\Requests\QuarterMonths;
use App\Http\Requests;

use App\Models\Student;
use App\Models\Quarter;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Month;
use App\Models\Grade;

use Notify;

class AttendanceController extends Controller
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

  public function show($grade, $quarter, $id)
  {
    $attendance = Attendance::where('quarter_id', Quarter::isLive()
                  ->where('slug', $quarter)->pluck('id')->first())
                  ->where('grade_id', Grade::where('slug', $grade)->pluck('id')->first())
                  ->where('student_id',$id )->first();

    return view('quarters.attendance.edit', [
      'grade' => $grade,
      'quarter' => $quarter,
      'attendance' => $attendance
    ]);
  }

  public function update($grade, $quarter, $id, QuarterMonths $request)
  {
    $attendance = Attendance::where('quarter_id', Quarter::isLive()
                  ->where('slug', $quarter)->pluck('id')->first())
                  ->where('student_id', $id)->first();
    $getStudent = Student::where('id',$id)->first();

    $attendance->update([
      'first_month' => $request->first_month,
      'second_month' => $request->second_month,
      'third_month' => $request->third_month,
    ]);

    notify()->flash($getStudent->name." Attendance has been updated", 'success',[
      'timer' => 5000,
    ]);

    activity($grade)
      ->causedBy(Auth::user())
      ->performedOn($attendance)
      ->withProperties([
        'attributes' => [
          'first_month' => $request->first_month,
          'second_month' => $request->second_month,
          'third_month' => $request->third_month,
        ],
        'old' => [
          'first_month' => $attendance->first_month,
          'second_month' => $attendance->second_month,
          'third_month' => $attendance->third_month,
        ],
        'description' => 'updated',
        'type' => 'success'
      ])
      ->log($getStudent->name.' Attendance has been updated successfull by '. Auth::user()->name);


    return redirect()->route('grade.show',[$grade]);
  }

  public function showupload($class)
  {
    return view('quarters.attendance.upload',[
      'grade' => $class
    ]);
  }

  public function storeupload($class, Request $request)
  {
    $file = $request->file('sheet');

    $SheetCollection = Excel::load($file)->ignoreEmpty();
    $rowCollection = $SheetCollection->all();
    # A very unsecured way for quick validation
    $urltitle = $class;

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

                activity($class)
                  ->causedBy(Auth::user())
                  ->withProperties(['type' => 'danger'])
                  ->log('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle.'
                  and you don\'t have any invalid charcters in your excel sheet');

                return redirect()->back();
            }
          }
        });

        foreach ($filtered as $key => $cell)
        {
          if (!empty($cell['student_id']) && !empty($cell['name']) && !empty($cell[strtolower($months[0]['name'])]))
          {
            $attendance = Attendance::where('quarter_id', $id)
            ->where('student_id', $cell['student_id'])->first();

            $attendance->update([
              'first_month' => $cell[strtolower($months[0]['name'])],
              'second_month' => $cell[strtolower($months[1]['name'])],
              'third_month' => $cell[strtolower($months[2]['name'])]
            ]);
            $cellCollection [] = $cell->toArray();

            activity($class)
              ->causedBy(Auth::user())
              ->performedOn($attendance)
              ->withProperties([
                'attributes' => [
                  'first_month' => $cell[strtolower($months[0]['name'])],
                  'second_month' => $cell[strtolower($months[1]['name'])],
                  'third_month' => $cell[strtolower($months[2]['name'])],
                ],
                'old' => [
                  'first_month' => $attendance->first_month,
                  'second_month' => $attendance->second_month,
                  'third_month' => $attendance->third_month,
                ],
                'description' => 'updated',
                'type' => 'success'
              ])
              ->log('You have success full uploaded the attendance for '.$urltitle.' To see the changes checkout activity logs');
          }
        }
      }
      notify()->flash('You have success full uploaded the attendance for '.$urltitle.' To see the changes checkout activity logs', 'success',['timer' => 5000]);



      return redirect()->route('grade.show',$class);

    }else {
      notify()->flash('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle, 'danger',['timer' => 5000]);

      activity($class)
        ->causedBy(Auth::user())
        ->withProperties(['type' => 'danger'])
        ->log('Something is wrong with your excel sheet, Make sure the name of the file is '.$urltitle);

      return redirect()->back();
    }

  }
}
