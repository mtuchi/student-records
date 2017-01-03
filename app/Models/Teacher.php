<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
  protected $fillable = ['user_id', 'grade_id','subject_id', 'slug'];

  public function getRouteKeyName()
	{
		return 'slug';
	}

  public function scopeLatestFirst($query)
  {
    return $query->orderBy('created_at','desc');
  }

  public function user()
  {
    return $this->belongsTo(User::class,'user_id');
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class,'subject_id');
  }

  public function grade()
  {
    return $this->belongsToMany(Grade::class);
  }

}
