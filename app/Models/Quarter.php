<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Score;
use App\Models\Subject;

class Quarter extends Model
{
  protected $fillable = ['name','live'];

  public function scopeIsLive($query)
  {
    return $query->where('live', true);
  }

  public function score()
  {
    return $this->hasMany('App\Models\Score', 'quarter_id');
  }

}
