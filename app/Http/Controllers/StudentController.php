<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

use App\Http\Requests;

use App\Models\Quarter;
use App\Models\Student;
use App\Models\Score;

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

      public function show($id)
      {
        $data = Student::where('id', $id)->with('grade')->first();
        $teacher = Auth::user()->subjects->first();

        $results = function() use($id,$teacher){
          if (Auth::user()->hasRole('class_teacher')) {
            // Can see student scores of all subjects and attendance + remarks
            return Quarter::isLive()->with(['score' => function ($query) use($id) {
                $query->where('student_id', $id);
            },'attendance' => function ($q) use($id) {
                $q->where('student_id', $id);
            },'months'])->get();
          }
          if (Auth::user()->hasRole('teacher')) {
            // Can see only scores for his/her subject
            return Quarter::isLive()->with(['score' => function ($query) use($id, $teacher) {
                $query->where('student_id', $id)
                      ->where('subject_id', $teacher->subject_id);
            },'months'])->get();
          }
        };

        $res = Score::where('student_id', $id)->get();
        //
        dd($res);

        return view('settings.student.profile',[
          'student' => $data,
          'results' => $results()
        ]);
      }

      public function update(Request $request)
      {
        return view('settings.edit.profile');
      }
}
