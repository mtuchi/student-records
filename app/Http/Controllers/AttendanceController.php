<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\QuarterMonths;
use App\Http\Requests;

use App\Models\Student;
use App\Models\Quarter;
use App\Models\Attendance;
use App\Models\User;
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

    return view('quarters.edit_attendance', [
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


    return redirect()->route('grade.show',[$grade]);
  }
}
