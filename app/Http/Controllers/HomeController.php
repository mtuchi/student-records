<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subject;
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
        $subjects = Auth::user()->subjects()->get();
        return view('home', compact('subjects'));
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

		dd($file->path());

		return redirect('/home');
    }
}
