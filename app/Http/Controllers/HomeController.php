<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Quarter;

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
      return view('subjects.subject');
    }

    /**
     * Show the users quaters data.
     *
     * @return \Illuminate\Http\Response
     */
    public function quarter(Subject $subject)
    {
      $user = Auth::user()->username;
      return view('quarters.quarter', [
        'user' => $user,
        'subject' => $subject
      ]);
    }

    public function upload()
    {
		  return view('upload');
    }


    public function store(Request $request)
    {
  		$file = $request->file('sheet');

  		$rowCollection = Excel::load($file)->all();

  		return redirect('/');
    }

    public function tinker()
    {
      $tmp = Quarter::with('score')->isLive()->get();
      dd($tmp);
    }

}
