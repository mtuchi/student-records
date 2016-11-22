<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Score;
use App\Models\Student;
use App\Models\Quarter;
use App\Models\Subject;
use App\Models\Grade;

class ScoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $students = Grade::pluck('students');
      $quarters = Quarter::isLive()->get();
      $subjects = Subject::whereIn('id', [1,2])->pluck('id');
      $faker = Faker::create();

      foreach ($quarters as $key => $value)
      {
        foreach (json_decode($students[0]) as $first)
         {
          factory(Score::class)->create([
            'student_id' => $first,
            'subject_id' => $subjects[0],
            'quarter_id' => $value['id'],
            'first_month'=> $faker->randomNumber($nbDigits = 2),
            'second_month' => $faker->randomNumber($nbDigits = 2),
            'third_month' => $faker->randomNumber($nbDigits = 2),
          ]);
        }
        foreach (json_decode($students[1]) as $second)
         {
          factory(Score::class)->create([
            'student_id' => $second,
            'subject_id' => $subjects[1],
            'quarter_id' => $value['id'],
            'first_month'=> $faker->randomNumber($nbDigits = 2),
            'second_month' => $faker->randomNumber($nbDigits = 2),
            'third_month' => $faker->randomNumber($nbDigits = 2),
          ]);
        }
      }
    }
}
