<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Http\Requests\AddTeacherFormRequest;

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

      return view('teacher.add');
    }

    public function store(AddTeacherFormRequest $request)
    {
			dd($request);

      $user = User::create([
          'name' => $request['name'],
          'email' => $request['email'],
          'password' => bcrypt($request['password']),
          'DOB' => $request['dob'],
          'gender' => $request['gender'],
          'phone' => $request['phone'],
      ]);

      return response()->json(['data' => $user]);
    }

}
