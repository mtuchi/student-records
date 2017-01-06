<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

	public function grade()
	{
		// return $this->belongsToMany(Grade::class);
		return $this->morphToMany(Grade::class,'gradeable');
	}

	public function score()
	{
		return $this->hasMany(Score::class);
	}

	public function teacher()
	{
		return $this->hasMany(Teacher::class);
	}
}
