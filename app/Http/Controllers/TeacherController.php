<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EditTeacherFormRequest;

use App\Models\User;
use App\Models\Grade;

use Auth;

class TeacherController extends Controller
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

	public function edit($id)
	{
		$user = User::where('id', $id)->with('grade','teacher')->first();
		// dd($user);
		return view('teacher.edit',['user' => $user,'id' => $id]);
	}

	public function show($id)
	{
		$user = User::where('id', $id)->firstOrFail();
		return view('teacher.show',['user' => $user,'id' => $id]);
	}

	public function update($id, EditTeacherFormRequest $request)
	{
		$user = User::where('id', $id)->first();

		activity('update-teacher')
		->causedBy(Auth::user())
		->performedOn($user)
		->withProperties([
		'attributes' => [
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
				'dob' => $request->dob,
				'gender' => $request->gender,
				'phone' => $request->phone,
		],
		'old' => [
				'name' => $user->name,
				'username' => $user->username,
				'email' => $user->email,
				'dob' => $user->dob,
				'gender' => $user->gender,
				'phone' => $user->phone,
		],
		'type' => 'success',
		])
		->log($user->name." Records has been updated successful by ". Auth::user()->name);

		$user->update([
			 'name' => $request->name,
			 'username' => $request->username,
			 'email' => $request->email,
			 'dob' => $request->dob,
			 'gender' => $request->gender,
			 'phone' => $request->phone,
	 ]);

	 notify()->flash($user->name." has been updated", 'success');

	 return redirect('teachers');
	}

	public function index()
	{
		$users = User::with(['roles' => function($q){
			$q->whereIn('name', ['teacher','class_teacher','admin']);
		},'teacher'])->get();

		return view('teacher.index',[
			'teachers' => $users
		]);
	}

	public function create()
	{
		return view('teacher.create');
	}

	public function store(EditTeacherFormRequest $request)
	{
		$user = User::create([
				'name' => $request->name,
				'username' => $request->username,
				'email' => $request->email,
				'dob' => $request->dob,
				'gender' => $request->gender,
				'phone' => $request->phone,
				'password' => bcrypt($request->password),
		]);

		activity('created-teacher')
		->causedBy(Auth::user())
		->performedOn($user)
		->withProperties([
		'attributes' => [
			'name' => $request->name,
			'username' => $request->username,
			'email' => $request->email,
			'dob' => $request->dob,
			'gender' => $request->gender,
			'phone' => $request->phone,
			'password' => "For security purpose the password is hashed",
		],
		'type' => 'success',
		])
		->log($user->name." Records has been created successful by ". Auth::user()->name);

		notify()->flash($request->name." has been added", 'success');

		return redirect('teachers');
	}

	public function delete($id)
	{
		$user = User::where('id', $id)->first();
		return view('settings.delete.teacher',['id' => $id,'user' => $user]);
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		$user->onlyTrashed()->where('id', $id)->first();

		activity('deleted-teacher-user')
		->causedBy(Auth::user())
		->performedOn($user)
		->withProperties([
		'attributes' => [
			'name' => $user->name,
			'username' => $user->username,
			'email' => $user->email,
			'dob' => $user->dob,
			'gender' => $user->gender,
			'phone' => $user->phone,
			'password' => "For security purpose the password is hashed",
		],
		'type' => 'success',
		])
		->log($user->name." Records has been deleted successful by ". Auth::user()->name);

		notify()->flash($user->name. "record deleted", 'success');

		return redirect('teachers');
	}
}
