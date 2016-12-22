<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

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
      return view('main.index');
    }

    public function tinker()
    {
      $activity = Activity::all();

      return view('teacher.add');
    }

}
