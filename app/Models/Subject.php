<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quarter;
use App\Models\User;

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
		return $this->belongsToMany(Grade::class);
	}
}
