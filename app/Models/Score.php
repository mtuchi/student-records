<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Subject;

class Score extends Model
{
  protected $fillable = ['quarter_id','subject_id','student_id','first_month','second_month','third_month'];

  public function student()
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  public function quarter()
  {
    return $this->belongsTo(Quarter::class,'quarter_id');
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class,'subject_id');
  }

}
