<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$firstPatch = Student::whereIn('id', range(6,10))->get();
      //Seed quarter_subject table with 4 entries
       foreach ($firstPatch as $student)
       {
				 	$stundent->subject()->attach(1);
       }

			 $secondPatch = Student::whereIn('id', range(1,5))->get();

       foreach ($secondPatch as $student)
       {
				 	$student->subject()->attach(2);
       }
    }
}
