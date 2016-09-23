<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Quarter extends Model
{
  protected $fillable = ['name','live'];

  public function scopeIsLive($query)
  {
    return $query->where('live', true);
  }

  public function score()
  {
    return $this->hasMany('App\Models\Score','quarter_id');
  }

  public function student()
  {
    return $this->hasMany('App\Models\Score', 'student_id');
  }

  public function subject()
  {
    return $this->hasMany('App\Models\Score', 'subject_id');
  }

}
