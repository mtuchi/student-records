<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Quarter;
class SubjectQuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $subjects = Subject::pluck('id');
      $quarters = Quarter::pluck('id');
      // dd($subjects);
      
      foreach ($subjects as $subject)
      {
        foreach ($quarters as $quarter)
        {
          DB::table('quarter_subject')->insert(
            [
              'quarter_id' => $quarter,
              'subject_id' => $subject,
            ]
          );
        }
      }
    }
}
