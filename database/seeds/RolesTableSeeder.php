<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arr = [
        'class_teacher', 'teacher', 'admin', 'register',
      ];

      foreach ($arr as $val)
      {
        DB::table('roles')->insert([
          'name' => $val
        ]);
      }
    }
}
