<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  protected $fillable = ['quarter_id','grade_id','student_id','first_month','second_month','third_month'];

}
