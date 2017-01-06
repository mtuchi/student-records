<?php

use Illuminate\Database\Seeder;

use App\Models\Student;
use App\Models\Grade;

class GradeStudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$first = Student::where('id','<=', 5)->get();
			$second = Student::where('id','>', 5)->get();
			$firstGrade = Grade::find(1);
			$secondGrade = Grade::find(2);

      foreach ($first as $student)
      {
				$firstGrade->student()->attach($student->id);
      }

      foreach ($second as $student)
      {
				$secondGrade->student()->attach($student->id);
      }
    }
}
