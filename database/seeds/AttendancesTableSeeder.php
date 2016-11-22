<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Quarter;
use App\Models\Grade;
use App\Models\Attendance;

class AttendancesTableSeeder extends Seeder
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
      $grades = Grade::all();
      $faker = Faker::create();

      foreach ($quarters as $key => $value)
      {
        foreach (json_decode($students[0]) as $first)
         {
          factory(Attendance::class)->create([
            'student_id' => $first,
            'grade_id' => $grades[0]['id'],
            'quarter_id' => $value['id'],
            'first_month'=> $faker->randomNumber($nbDigits = 2),
            'second_month' => $faker->randomNumber($nbDigits = 2),
            'third_month' => $faker->randomNumber($nbDigits = 2),
          ]);
        }
      foreach (json_decode($students[1]) as $second)
       {
        factory(Attendance::class)->create([
          'student_id' => $second,
          'grade_id' => $grades[1]['id'],
          'quarter_id' => $value['id'],
          'first_month'=> $faker->randomNumber($nbDigits = 2),
          'second_month' => $faker->randomNumber($nbDigits = 2),
          'third_month' => $faker->randomNumber($nbDigits = 2),
        ]);
       }
    }
  }
}
