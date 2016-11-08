<?php

use Illuminate\Database\Seeder;
use App\Models\Quarter;
use App\Models\Grade;

class GradeQuarterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $quarters = Quarter::isLive()->pluck('id')->all();
      $grades = Grade::pluck('id')->all();

      foreach ($quarters as $quarter)
      {
        foreach ($grades as $grade)
        {
          DB::table('grade_quarter')->insert(
            [
              'quarter_id' => $quarter,
              'grade_id' => $grade,
            ]
          );
        }
      }
    }
}
