<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

use App\Http\Requests;

use App\Models\Grade;
use App\Models\Teacher;

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
    $teachers = Teacher::where('grade_id', $grade->id)->with('subject', 'teacher')->get();

    $collect = [$grade->slug];
    foreach ($teachers as $key => $value)
    {
      $collect[] = $grade->slug."-".$value->subject->name;
    }

    $activity = Activity::latest()->inLog($collect)->get();
    $overview = Activity::latest()->inLog($collect)->paginate(2);

    return view('settings.user.profile',[
      'user' => $data,
      'teachers' => $teachers,
      'activities' => $activity,
      'overviewActivities' => $overview
    ]);
  }

  public function update(Request $request)
  {
    return view('settings.edit.profile');
  }

}
