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

      factory(Teacher::class)->create([
        'user_id' => 1,
        'grade_id' => 1,
        'subject_id' => 1,
        'slug' => 'Mathematics-IVA'
      ]);

      factory(Teacher::class)->create([
        'user_id' => 2,
        'grade_id' => 2,
        'subject_id' => 2,
        'slug' => 'English-IIB'
      ]);

      factory(Teacher::class)->create([
        'user_id' => 3,
        'grade_id' => 2,
        'subject_id' => 3,
        'slug' => 'Kiswahili-IIB'
      ]);
    }
}
