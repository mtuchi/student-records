<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Subject;
use App\Models\Quarter;
use App\Models\Grade;
use App\Models\Score;
use App\Models\Student;

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


    public function quarter(Subject $subject)
    {
      $user = Auth::user()->username;
      return view('quarters.quarter', [
        'user' => $user,
        'subject' => $subject
      ]);
    }


	/**
     * Show the upload view.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
		return view('upload');
    }

	/**
     * Store uploaded test scores and redirect to home.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
  		$file = $request->file('sheet');

  		$rowCollection = Excel::load($file)->all();

  		return redirect('/');
    }

    public function tinker(Quarter $quarter, Subject $subject)
    {
      $data = $quarter->with('score')->isLive()->get();
      $nugets = $subject->with('score')->get();

      dd($nugets);


    }

}
