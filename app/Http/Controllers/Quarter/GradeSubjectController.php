<?php

namespace App\Http\Controllers\Quarter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Subject;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Score;
use App\Models\User;
use App\Models\Grade;
use App\Models\Teacher;

class GradeSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($grade)
    {

			$id = Grade::where('slug', $grade)->pluck('id')->first();
			$grade = Grade::where('user_id', Auth::user()->id)->first();
			$user = Auth::user()->username;
			$quarters = Quarter::isLive()->with(['attendance' => function ($query) use($id) {
					$query->where('grade_id', $id);
			},'months'])->get();

			$students = Student::whereIn('id', json_decode($grade->students))->get();
			return view('quarters.attendance.index', [
				'user' => $user,
				'grade' => $grade,
				'quarters' => $quarters,
				'students' => $students
			]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
