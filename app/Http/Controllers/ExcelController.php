<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\Subject;
use App\Models\Quarter;
use App\Models\Score;
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

  public function upload(Request $request, Subject $subject)
  {
    $file = $request->file('sheet');

    $SheetCollection = Excel::load($file)->ignoreEmpty();
    $rowCollection = $SheetCollection->all();
    $cellCollection = [];
    $Arr = [];
    foreach ($rowCollection as $collection)
    {
      foreach ($collection as $cell)
      {
        if (!empty($cell['student_id']) && !empty($cell['name']) && !empty($cell['first_month']))
        {
          $score = Score::where('subject_id', $subject->id)->where('quarter_id', $cell['quarter_id'])
          ->where('student_id', $cell['student_id'])->first();

          $score->update([
            'first_month' => $cell['first_month'],
            'second_month' => $cell['second_month'],
            'third_month' => $cell['third_month']
          ]);
          $cellCollection [] = $cell->toArray();
        }
      }
    }

    return redirect()->route('user.subject',$subject);

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
                'Student ID' => $scoreCollection['student_id'],
                'Quarter ID' => $scoreCollection['quarter_id'],
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
