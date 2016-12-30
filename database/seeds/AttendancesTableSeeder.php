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
      $quarters = Quarter::isLive()->get();
      $grades = Grade::all();
      $faker = Faker::create();

      foreach ($quarters as $key => $value)
      {
        foreach (range(1,5) as $first)
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
      foreach (range(6,10) as $second)
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
