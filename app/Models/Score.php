<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
  protected $fillable = ['quarter','student_id','first_month','second_month','third_month'];

}
