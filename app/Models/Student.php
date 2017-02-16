<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Student extends Model
{
	use SoftDeletes;
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'gender','dob','guardian','emergency_contact'];

	public function score()
	{
		return $this->hasMany(Score::class);
	}

	public function grade()
	{
		return $this->morphTo(Grade::class,'gradeable');
	}

	public function age()
	{
		$dob = $this->dob;
		$dob = explode('-',$dob);

		return Carbon::createFromDate($dob[0], $dob[1], $dob[2])->age;
	}

	public function avatar($options = [])
	{
		$size = isset($options['size']) ? $options['size']:45;
		$image = isset($options['image']) ? $options['image']:'identicon';

		return 'http://www.gravatar.com/avatar/' .md5('student@gonzaga.ac.tz'). '?s=' . $size . '&d='. $image;
	}

  public function joined()
  {
    return $this->created_at->diffForHumans();
  }

	public function hasGrade($grade)
	{
		$grades = collect($this->grade->pluck('name')->toArray());
		return $grades->contains($grade);
	}

	public function subject()
	{
		return $this->hasMany(Subject::class);
	}

}
