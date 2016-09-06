<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsSeeder extends Seeder
{
    protected $subject;
    public function __construct(Subject $subject)
    {
      $this->subject = $subject;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
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
        foreach ($arr as $key => $value) {
          $this->subject->firstOrCreate([
            'subject'=> $value
          ]);
        }

    }
}
