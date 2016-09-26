<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quarter;

class Subject extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','class', 'slug'];

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function score()
	{
		return $this->hasMany('App\Models\Score', 'subject_id')->with('subject','student');
	}

}
