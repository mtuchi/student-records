<?php

namespace App\Repositories;

use App\Models\{Role, Permission};

/**
 *
 */
trait HasPermissionTrait
{
	public function givePermissionTo(...$permissions)
	{
		// get permissions Model
		$permissions = $this->getPermissions(array_flatten($permissions));
		if ($permissions === null) {
			 return $this;
		}

		// saveMany to the users
		$this->permissions()->saveMany($permissions);
		return $this;
	}

	public function withDrawPermissionTo(...$permissions)
	{
		// get permissions Model
		$permissions = $this->getPermissions(array_flatten($permissions));

		// detach works even with null
		// if ($permissions === null) {
		// 	 return $this;
		// }

		// detach to the users
		$this->permissions()->detach($permissions);
		return $this;
	}

	public function refreshPermissions(...$permissions)
	{
		$this->permissions()->detach();

		return $this->givePermissionTo($permissions);
	}

	public function hasRole(...$roles)
	{
		foreach ($roles as $role) {
			if ($this->roles->contains('name', $role)) {
				 return true;
			}
			return false;
		}
	}

	public function hasPermissionTo($permission)
	{
		// Has permission through a role
		return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
	}

	protected function hasPermissionThroughRole($permission)
	{
		foreach ($permission->roles as $role) {
			if ($this->roles->contains('name', $role)) {
				return true;
			}
			return false;
		}
	}

	protected function getPermissions(array $permissions)
	{
		return Permission::whereIn('name', $permissions)->get();
	}


	protected function hasPermission($permission)
	{
		return (bool) $this->permissions->where('name', $permission->name)->count();
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
