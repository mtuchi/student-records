<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$permissions = [
				'edit post', 'delete post', 'revoke user'
			];

			foreach ($permissions as $permission)
			{
				$insert = Permission::updateOrCreate([
					'name' => $permission
				]);
			}
    }
}
