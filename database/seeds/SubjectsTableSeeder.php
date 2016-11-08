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

        $arr = [
            'Mathematics',
            'English',
            'Kiswahili',
            'Science',
            'Arts',
            'Sport',
            'General Manner',
            'Vocational Skills',
            'Civics',
            'Geography',
            'History',
            'French',
            'Social Studies',
          ];

        foreach ($arr as $v)
        {
          factory(Subject::class)->create(['name' => $v]);
        }

    }
}
