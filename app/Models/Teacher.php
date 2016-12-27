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

  public function teacher()
  {
    return $this->belongsTo(User::class, 'user_id');
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class,'subject_id');
  }

  public function grade()
  {
    return $this->belongsToMany(Grade::class);
  }

  private function getIdInArray($array, $term)
  {
   foreach ($array as $key => $value)
   {
       if ($value['name'] == $term)
       {
           return $key;
       }
   }
  }


  public function makeGrade($title)
  {
    $assaigned_grade = [];
    $grades = Grade::all()->keyBy('id')->toArray();

     switch ($title)
     {
       case 'IV A':
           $assaigned_grade[] = $this->getIdInArray($grades, 'IV A');
           break;

       case 'II B':
           $assaigned_grade[] = $this->getIdInArray($grades, 'II B');
           break;
       default:
           throw new \Exception("The grade status entered does not exist");
     }

     $this->grade()->attach($assaigned_grade);
   }

  }
