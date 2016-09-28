<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Subject;
use Request;

class Quarter extends Model
{
  protected $fillable = ['name','live'];

  public function scopeIsLive($query)
  {
    return $query->where('live', true);
  }

  public function score()
  {
    return $this->hasMany(Score::class)->where('subject_id', Request::route()->subject->id);
  }
  
}
