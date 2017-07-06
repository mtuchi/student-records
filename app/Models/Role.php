<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name'];

  /**
  * Set timestamps off
  */
  public $timestamps = false;

  /**
  * Get users with a certain role
  */

  public function users()
  {
      return $this->belongsToMany(User::class);
  }

	public function permissions()
	{
		return $this->belongsToMany(Permission::class,'permission_role');
	}
}
