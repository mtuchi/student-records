<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Subject;
use App\Models\Student;
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
      return view('subjects.index');
    }

    public function tinker()
    {
      $activity = Activity::all();

      // dd($activity);

      foreach ($activity as $key => $value) {
        dd($value->changes);
      }
    }

}
