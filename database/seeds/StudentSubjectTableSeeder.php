<?php

use Illuminate\Database\Seeder;

class StudentSubjectTableSeeder extends Seeder
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
           DB::table('student_subject')->insert(
             [
               'student_id' => $student,
               'subject_id' => 1,
             ]
           );
       }

       foreach (range(1,5) as $student)
       {
           DB::table('student_subject')->insert(
             [
               'student_id' => $student,
               'subject_id' => 2,
             ]
           );
       }
    }
}
