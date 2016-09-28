<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Quarter;
use App\Http\Requests;

class ExcelController extends Controller
{
  public function indexUpload(Subject $subject)
  {
    return view('subjects.upload',[
      'subject' => $subject
    ]);
  }

  public function indexExport(Subject $subject)
  {
    return view('subjects.export', [
      'subject' => $subject
    ]);
  }

  public function upload(Request $request)
  {
    $file = $request->file('sheet');

    $SheetCollection = Excel::load($file)->get();
    $rowCollection = $SheetCollection->all();
    $collectionArr = [];
    foreach ($rowCollection as $collection) {
      $collectionArr [] = $collection->toArray();
    }

    dd($rowCollection);

    return redirect('/');
  }

  public function export(Subject $subject)
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
    Excel::create($subjectName, function($excel) use ($collectionArr, $subjectName, $teacherName) {

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


    })->export('xlsx');

  }

  public function back()
  {
    return redirect()->back();
  }
}
