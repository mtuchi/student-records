<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [
        'class_teacher', 'teacher', 'admin', 'registrar',
      ];

      foreach ($roles as $role)
      {
				$insert = Role::updateOrCreate([
					'name' => $role
				]);
      }
    }
}
