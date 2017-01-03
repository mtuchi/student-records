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
      $firstTeacher = factory(Teacher::class)->create([
        'user_id' => 1,
        'grade_id' => 1,
        'subject_id' => 1,
        'slug' => 'Mathematics-Pre-A'
      ]);

      $firstTeacher->grade()->attach(1);

       $secondTeacher = factory(Teacher::class)->create([
        'user_id' => 2,
        'grade_id' => 6,
        'subject_id' => 2,
        'slug' => 'English-II-B'
      ]);

      $secondTeacher->grade()->attach(6);

      $thirdTeacher = factory(Teacher::class)->create([
        'user_id' => 3,
        'grade_id' => 6,
        'subject_id' => 3,
        'slug' => 'Kiswahili-II-B'
      ]);

      $thirdTeacher->grade()->attach(6);
    }
}
