<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;

class Student extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'gender'];

	public function subjects()
	{
		return $this->hasMany('App\Models\Subject');
	}

	public function scores()
	{
		return $this->hasMany('App\Models\Score','student_id');
	}

}
