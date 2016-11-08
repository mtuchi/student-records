<?php

use Illuminate\Database\Seeder;

class GradeSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arr1 = ['1','2','3','4','8','6','9','10','11'];
      foreach ($arr1 as $subject)
      {
          DB::table('grade_subject')->insert(
            [
              'subject_id' => $subject,
              'grade_id' => 1,
            ]
          );
      }

      $arr2 = ['1','2','3', '4', '8','6'];

      foreach ($arr2 as $subject)
      {
          DB::table('grade_subject')->insert(
            [
              'subject_id' => $subject,
              'grade_id' => 2,
            ]
          );
      }
    }
}
