<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function tinker(Subject $subject)
    {
      $collections = Quarter::with('score.student')->isLive()->get();
      // Convert each member of the returned collection into an array,
      // and append it to the payments array.
      $collectionArr = [];
      $subjectName = $subject->name;
      $teacherName = Auth::user()->name;
      $scores = [];
      foreach ($collections as $collection)
      {
          $collectionArr[] = $collection->toArray();
      }

      // Generate and return the spreadsheet
      Excel::create('grades', function($excel) use ($collectionArr, $subjectName, $teacherName) {

          // Set the spreadsheet title, creator, and description
          $excel->setTitle($subjectName);
          $excel->setCreator($teacherName)->setCompany('Gonzaga Gradesheet');
          $excel->setDescription('Student Quarterly grades');

          // Build the spreadsheet, passing in the collectionArr array
          foreach ($collectionArr as $collection)
          {
            $excel->sheet($collection['name'], function($sheet) use ($collection) {

              foreach ($collection['score'] as $scoreCollection)
              {
                $scores [] = [
                  'Name' => $scoreCollection['student']['name'],
                  'Sex' => $scoreCollection['student']['gender'],
                  'First Month' => $scoreCollection['first_month'],
                  'Second Month' => $scoreCollection['second_month'],
                  'Third Month' => $scoreCollection['third_month'],
                ];
              }
                $sheet->fromArray($scores, null, 'A1', false, true);
            });
          }


      })->download('xlsx');

      dd($scores);

    }

}
