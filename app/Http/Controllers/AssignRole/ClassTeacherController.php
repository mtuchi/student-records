<?php

namespace App\Http\Controllers\AssignRole;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradeFormRequest;

use App\Models\Grade;
use App\Models\User;

use Auth;
class ClassTeacherController extends Controller
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
			$slug = $class[0]."-".$class[1];

			$user = User::where('id', $id)->with('grade')->first();

			$grade = Grade::where('slug', $slug)->first();

			# checking if the user already assigned to a class
			if (count($user->grade) != 0) {
				if ($grade) {
					#check if grade has arleady been assigned to a teacher
					if ($grade->user_id) {

						notify()->flash("This class is already assigned to a teacher, choose another class", 'danger');

						return redirect($id.'/edit')
									 ->withInput();
					}else {
						# update old grade records before update to new record
						$old = $user->grade()->first();
						$old->update([
							'user_id' => null
						]);

						# update grade record in gradeables table
						$user->grade()->sync([$grade->id], true);
						# update grade record
						$grade->update([
							'user_id' => $id,
						]);


						#activity log
						activity('updated-class')
						->causedBy(Auth::user())
						->performedOn($user)
						->withProperties([
						'attributes' => [
							'id' => $id,
						],
						'type' => 'success',
						])
						->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

						notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

						return redirect('teachers');
					}
				}else {
					# This grade is not in the database create record now
					$user->hasRole('class_teacher') ? '': $user->attachRole('class_teacher');
					$old = $user->grade()->first();
					$old->update([
						'user_id' => null
					]);
					$newGrade = Grade::create([
						'user_id' => $id,
						'name' => $name,
						'stream' => $stream,
						'slug' => $slug
					]);

					# attach record In a relation table (gradeables)
					$user->grade()->sync([$newGrade->id], true);
					# activity log
					activity('assign-class')
					->causedBy(Auth::user())
					->performedOn($user)
					->withProperties([
					'attributes' => [
						'name' => $name,
						'stream' => $stream,
						'slug' => $slug,
					],
					'type' => 'success',
					])
					->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

					notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

					return redirect('teachers');
				}


			}else {
				# check if the class exist already
				if ($grade) {
					#check if grade has arleady been assigned to a teacher
					if ($grade->user_id) {

						notify()->flash("This class is already assigned to a teacher, choose another class", 'danger');

						return redirect($id.'/edit')
									 ->withInput();
					}else {
						#this grade has no class teacher assign now
						$user->hasRole('class_teacher') ? '': $user->attachRole('class_teacher');
						$grade->update([
							'user_id' => $id,
						]);

						# attach record In a relation table (gradeables)
						$grade->user()->attach($id);
						#activity log
						activity('updated-class')
						->causedBy(Auth::user())
						->performedOn($user)
						->withProperties([
						'attributes' => [
							'id' => $id,
						],
						'type' => 'success',
						])
						->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

						notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

						return redirect('teachers');
					}
				}else {
					# This grade is not in the database create record now
					$user->hasRole('class_teacher') ? '': $user->attachRole('class_teacher');
					$newGrade = Grade::create([
						'user_id' => $id,
						'name' => $name,
						'stream' => $stream,
						'slug' => $slug
					]);

					# attach record In a relation table (gradeables)
					$newGrade->user()->attach($id);
					# activity log
					activity('assign-class')
					->causedBy(Auth::user())
					->performedOn($user)
					->withProperties([
					'attributes' => [
						'name' => $name,
						'stream' => $stream,
						'slug' => $slug,
					],
					'type' => 'success',
					])
					->log($user->name." Class teacher role has been assigned successfull by ". Auth::user()->name);

					notify()->flash($user->name." class teacher role has been assigned successfull", 'success');

					return redirect('teachers');
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
			$user = User::find($id);
			$grade = Grade::where('user_id', $id)->first();
			# detach class teacher role
			$user->detachRole('class_teacher');
			# detach record from the relation table
			$user->grade()->detach();

			#remove user from the grade
			$grade->update([
				'user_id' => null
			]);

			activity('detach-class_teacher-role')
			->causedBy(Auth::user())
			->performedOn($user)
			->log($user->name." Records has been detached successful by ". Auth::user()->name);

			notify()->flash($user->name. "Class teacher record detached", 'success');

			return redirect('teachers');
    }
}
