<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Score;
use Repositories\Capture\Capture;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
				$subjects = Subject::all();
        return view('subjects.index',['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
					'name' => 'required|unique:subjects'
				]);

				Subject::create([
					'name' => $request->name
				]);

				return redirect('subjects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = Subject::where('id', $id)->firstOrFail();

				return view('subjects.show',['subject' => $subject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
			$subject = Subject::where('id', $id)->firstOrFail();
			$score = Score::where('subject_id',$id)->first();
			return view('subjects.edit',['subject' => $subject,'id' => $id,'score' => $score]);
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
			$subject = Subject::where('id', $id)->firstOrFail();

			$this->validate($request,[
				'name' => 'required'
			]);

			$subject->update([
				'name' => $request->name
			]);

			return redirect('subjects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$subject = Subject::where('id', $id)->firstOrFail();
			$score = Score::where('subject_id', $id)->first();
			if ($score) {
				notify()->flash($subject->name." was not deleted because it's already being used in scores", 'warning');

				return redirect('subjects');
			} else {
				$subject->delete();

				return redirect('subjects');
			}
    }
}
