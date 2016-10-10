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

  public function scopeLatestFirst($query)
  {
    return $query->orderBy('created_at','desc');
  }

  public function score()
  {
    // dd(Request::route()->subject);
    $id = Teacher::where('slug', Request::route()->subject)->pluck('subject_id')->first();
    return $this->hasMany(Score::class)->where('subject_id', $id);
  }

}
