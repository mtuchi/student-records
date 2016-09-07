<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
          'English',
          'Mathematics',
          'Kiswahili',
          'Science',
          'Arts',
          'Sport',
          'General Manner',
          'Vocational Skills',
          'Civics',
          'Geography',
          'History',
          'Social Studies',
          'French',
        ];

        foreach($subjects as $subject) {
            factory(Subject::class)->create([
                'name' => $subject
            ]);
        }
    }
}
