<?php
namespace Repositories\Capture;

use App\Models\Teacher;
use App\Models\Score;

class Capture
{
	public function checkConstraint($id)
	{
		$teacher = Teacher::subject()->where('id',$id)->firstOrFail();
		$subject = Score::where('subject_id', $id)->firstOrFail();
	}
}
