<?php

namespace App\Http\Controllers\AssignRole;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\User;

use Auth;
class TeacherController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
			$class = $request->class;
			$name = $class[0];
			$stream = $class[1];
			$slug = $name."-".$stream;

			$user = User::where('id', $id)->first();

			# check if user is already a subject teacher
			if (count($user->teacher) != 0) {
				# User is already a subject teacher
				# Check request
				if (isset($request->update)) {
					# check subject
					$grade = Grade::where('id', $user->teacher->first()->grade_id)->first();
					$subj = Subject::where('name', $request->subject)->first();
					$user->teacher->first()->update([
						'subject_id' => $subj->id,
						'slug' => $request->subject."-".$grade->slug
					]);

					notify()->flash($user->name."Is assigned teaching role for $request->subject in this class",'success');
					return redirect('teachers');

				} else {
					# check grade
					$grade = Grade::where('slug', $slug)->first();
					if ($grade) {
						# Create teacher record
						# check if the record is new
						$teacher = Teacher::where('slug', $request->subject."-".$slug)->first();
						if ($teacher) {
              if ($teacher->user_id) {
                # record exist warning the user
                notify()->flash($teacher->user->name."Is already teaching $request->subject in this class",'warning');
                return redirect($id.'/edit')
                       ->withInput();
              }else {
                # update record
                $teacher->update([
                  'user_id' => $id
                ]);

								$teacher->user()->first()->hasRole('teacher') ? '': $teacher->user()->first()->attachRole('teacher');
								$teacher->grade()->sync([$grade->id], true);

								notify()->flash($teacher->user->name."Is assigned teaching role for $request->subject in this class",'success');
                return redirect('teachers');
              }
						}else {
							$subject = Subject::where('name', $request->subject)->first();
							# record does not exist update teacher
							$new = Teacher::create([
								'user_id' => $id,
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $request->subject."-".$grade->slug
							]);

							$new->user()->first()->hasRole('teacher') ? '': $new->user()->first()->attachRole('teacher');
							$new->grade()->attach($grade->id);

							notify()->flash($new->user->name."Is assigned teaching role for $request->subject in this class",'success');
              return redirect('teachers');
						}
					}else {
						# The class chooesed does not have exist yet in grades table
						notify()->flash("The select class does not exist yet, choose another class", 'danger');
						return redirect($id.'/edit')
									 ->withInput();
					}
				}
			}else {
				# This is new Teacher
					# Check if Its update request a create request
					if (isset($request->update)) {
							# check if the record is new
							$teacher = Teacher::where('slug', $request->update)->first();
							if ($teacher) {
                # record exist warning the user
                notify()->flash($teacher->user->name."Is already teaching $request->update",'warning');
                return redirect($id.'/edit')
                       ->withInput();
							}else {
								$subject = Subject::where('name', $request->subject)->first();
								# record does not exist update teacher
								$new = Teacher::create([
									'user_id' => $id,
									'grade_id' => $grade->id,
									'subject_id' => $subject->id,
									'slug' => $request->subject."-".$grade->slug
								]);

								$new->user()->first()->hasRole('teacher') ? '': $new->user()->first()->attachRole('teacher');
								$new->grade()->attach($grade->id);

								notify()->flash($new->user->name."Is assigned teaching role for $request->subject in this class",'success');
                return redirect('teachers');
							}
					}else {
						# grade checkup
						$grade = Grade::where('slug', $slug)->first();
						if ($grade) {
							# Create teacher record
							# check if the record is new
							$teacher = Teacher::where('slug', $request->subject."-".$slug)->first();
							if ($teacher) {
                if ($teacher->user_id) {
                  # record exist warning the user
  								notify()->flash($teacher->user->name."Is already teaching $request->subject in this class",'warning');
  								return redirect($id.'/edit')
  											 ->withInput();
                }else {
                  # update record
                  $teacher->update([
                    'user_id' => $id
                  ]);

									$teacher->user()->first()->hasRole('teacher') ? '': $teacher->user()->first()->attachRole('teacher');
									$teacher->grade()->attach($grade->id);

									notify()->flash($teacher->user->name." Is assigned a teaching role for $request->subject",'success');
                  return redirect('teachers');
                }

							}else {
								$subject = Subject::where('name', $request->subject)->first();
								# record does not exist update teacher
								$new = Teacher::create([
									'user_id' => $id,
									'grade_id' => $grade->id,
									'subject_id' => $subject->id,
									'slug' => $request->subject."-".$grade->slug
								]);

								$new->user()->first()->hasRole('teacher') ? '': $new->user()->first()->attachRole('teacher');
								$new->grade()->attach($grade->id);

								notify()->flash($new->user->name."Is assigned teaching role for $request->subject in this class",'success');
                return redirect('teachers');
							}
						}else {
							# The class chooesed does not have exist yet in grades table
							notify()->flash("The select class does not exist yet, choose another class", 'danger');
							return redirect($id.'/edit')
										 ->withInput();
						}
					}
			}

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
			$teacher = Teacher::where('user_id', $id)->first();
			$user = User::find($id);

		 if (count($user->teacher()->get()) > 1) {

				 $teacher->grade()->detach($user->teacher()->first()->grade_id);
				 $teacher->update([
					 'user_id' => null
				 ]);

				 activity('deleted-subject-teacher')
				 ->causedBy(Auth::user())
				 ->log("Records has been deleted successful by ". Auth::user()->name);

				 notify()->flash("Records has been deleted successful by ". Auth::user()->name, 'success');

				 return redirect('teachers');
		 }else {
			 $teacher->grade()->detach($user->teacher()->first()->grade_id);
			 $teacher->update([
				 'user_id' => null
			 ]);
			 $user->detachRole('teacher');

			 activity('detach-teacher-role')
			 ->causedBy(Auth::user())
			 ->performedOn($user)
			 ->log($user->name." Records has been detached successful by ". Auth::user()->name);

			 notify()->flash($user->name. "Subject teacher record detached", 'success');

			 return redirect('teachers');
		 }

    }
}
