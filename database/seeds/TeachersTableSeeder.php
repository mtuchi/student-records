<?php

use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*
      * standards and subjects will be an array that need to be json_encode on data entry
      */
      $standards = [1,4];
      $subjects = [2,6];

      Teacher::truncate();
      factory(Teacher::class)->create([
        'assigned_subjects' => json_encode($subjects)
      ]);

    }
}
