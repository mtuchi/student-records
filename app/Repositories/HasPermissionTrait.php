<?php

namespace App\Repositories;

use App\Models\{Role, Permission};

/**
 *
 */
trait HasPermissionTrait
{
	public function hasRole(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('name', $role)) {
				 return true;
			}
			return false;
		}
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class,'role_user');
	}

	public function permissions()
	{
		return $this->belongsToMany(Permission::class,'permission_user');
	}
}
