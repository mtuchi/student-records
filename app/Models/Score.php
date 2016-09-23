<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Grade;

class Score extends Model
{
  protected $fillable = ['quarter_id','subject_id','student_id','first_month','second_month','third_month'];

  public function student()
  {
    return $this->belongsTo('App\Models\Student','student_id');
  }

  public function quarter()
  {
    return $this->belongsTo('App\Models\Quarter','quarter_id');
  }

  public function subject()
  {
    return $this->belongsTo('App\Models\Subject','subject_id');
  }

}
