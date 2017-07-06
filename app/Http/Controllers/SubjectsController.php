<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Score;
use App\Repositories\Constraint;

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
    public function edit($id, Constraint $constraint)
    {
			$subject = Subject::where('id', $id)->firstOrFail();
			$check = $constraint->check($id);

			return view('subjects.edit',['subject' => $subject,'id' => $id,'check' => $check]);
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
    public function destroy($id, Constraint $constraint)
    {

			$subject = Subject::where('id', $id)->firstOrFail();
			$subject->delete();

			return redirect('subjects');
    }
}
