<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Subject;
use App\Models\Quater;

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


    public function quater(Subject $subject)
    {
      $quaters = Quater::all();
      $user = Auth::user()->username;

      return view('quaters.quater', [
        'user' => $user,
        'subject' => $subject,
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
		dump("Month of the Quarter: " . $rowCollection->getTitle());
		dump($cellCollection = $rowCollection->all());
		foreach($cellCollection as $cell) {
			if(!empty($cell->name))
				dump("Name: " . $cell->name . " | Score: " . $cell->score);
		}

		die("It works!");

		return redirect('/home');
    }

}
