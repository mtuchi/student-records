<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $fillable = ['quarter_id','grade_id','student_id','first_month','second_month','third_month'];

  public function scopeLatestFirst($query)
  {
    return $query->orderBy('created_at','desc');
  }
  public function student()
  {
    return $this->belongsTo(Student::class, 'student_id');
  }

  public function quarter()
  {
    return $this->belongsTo(Quarter::class,'quarter_id');
  }

  public function grade()
  {
    return $this->belongsTo(Grade::class,'grade_id');
  }

  public function months()
  {
    return $this->belongsTo(Month::class,'quarter_id');
  }
}
