<?php

use Illuminate\Database\Seeder;

class GradeStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (range(6,10) as $student)
      {
          DB::table('grade_student')->insert(
            [
              'student_id' => $student,
              'grade_id' => 1,
            ]
          );
      }

      foreach (range(1,5) as $student)
      {
          DB::table('grade_student')->insert(
            [
              'student_id' => $student,
              'grade_id' => 2,
            ]
          );
      }
    }
}
