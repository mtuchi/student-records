<?php
namespace App\Repositories;

use App\Models\Teacher;
use App\Models\Score;
use App\Models\Subject;

class Constraint
{
	public function check($id)
	{
		$teacher = new Teacher;
		$score = new Score;
		$subject = new Subject;

		if ($teacher->subject()->where('id',$id)->first()) {
			# record exist
			return;
		}elseif ($score->where('subject_id', $id)->first()) {
			# record exist
			return;
		}else {
			return $subject->where('id', $id)->first();
		}
	}
}
