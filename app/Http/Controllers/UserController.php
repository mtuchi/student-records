<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

use App\Http\Requests;

use App\Models\Grade;
use App\Models\Teacher;
use App\Models\User;

class UserController extends Controller
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

  public function show($user)
  {
    $data = Auth::user()->where('username', $user)->with('subjects.teacher','subjects.subject')->first();
    $grade = Grade::where('user_id', Auth::user()->id)->first();

    $teachers = function() use($grade, $data){
      if (Auth::user()->hasRole('class_teacher','teacher')) {
        return Teacher::where('grade_id', $grade->id)->with('subject', 'teacher')->get();
      }
      if (Auth::user()->hasRole('teacher')) {
        return $data->subjects;
      }
    };

    $activity = function() use($grade, $teachers, $data){
      if (Auth::user()->hasRole('class_teacher','teacher')) {
        $collect = [$grade->slug];

        foreach ($teachers as $key => $value)
        {
          $collect[] = $grade->slug."-".$value->subject->name;
        }

        return Activity::latest()->inLog($collect)->get();
      }
      if (Auth::user()->hasRole('teacher')) {
          $collect = [];

          foreach ($data->subjects as $key => $value)
          {
            $collect[] = Grade::where('id',$value->grade_id)->pluck('slug')->first()."-".$value->subject->name;
          }

        return Activity::latest()->inLog($collect)->get();
      }
    };

    $overview = function() use($grade, $teachers, $data){
      if (Auth::user()->hasRole('class_teacher') && Auth::user()->hasRole('teacher')) {
        $collect = [$grade->slug];

        foreach ($teachers as $key => $value)
        {
          $collect[] = $grade->slug."-".$value->subject->name;
        }

        return Activity::latest()->inLog($collect)->paginate(2);
      }
      if (Auth::user()->hasRole('teacher')) {
          $collect = [];
          foreach ($data->subjects as $key => $value)
          {
            $collect[] = Grade::where('id',$value->grade_id)->pluck('slug')->first()."-".$value->subject->name;
          }

        return Activity::latest()->inLog($collect)->paginate(2);
      }
    };

    return view('settings.user.profile',[
      'user' => $data,
      'teachers' => $teachers(),
      'activities' => $activity(),
      'overviewActivities' => $overview()
    ]);
  }

	// This method below is in accurate needs some fixing
  public function update()
  {
    return view('settings.edit.profile');
  }

}
