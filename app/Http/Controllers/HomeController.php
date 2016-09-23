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
use App\Transformers\ScoreTransformer;
use App\Transformers\QuarterTransformer;
use App\Transformers\SubjectTransformer;

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
      $quarters = fractal()
      ->collection(Subject::get())
      ->transformWith(new SubjectTransformer)
      ->toArray();

      $user = Auth::user()->username;

      return view('quarters.quarter', [
        'user' => $user,
        'subject' => $subject,
        'quarters' => $quarters
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

    public function tinker()
    {
      $subjects = fractal()
      ->collection(Subject::get())
      ->transformWith(new SubjectTransformer)
      ->toArray();

      dd($subjects);

    }

}
