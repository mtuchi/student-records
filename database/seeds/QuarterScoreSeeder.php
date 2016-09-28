<?php

use Illuminate\Database\Seeder;
use App\Models\Score;
use App\Models\Quarter;

class QuarterScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $scores = Score::pluck('id');
      $quarters = Quarter::isLive()->pluck('id');
      // dd($scores);

      foreach ($scores as $score)
      {
        foreach ($quarters as $quarter)
        {
          DB::table('quarter_score')->insert(
            [
              'quarter_id' => $quarter,
              'score_id' => $score,
            ]
          );
        }
      }
    }
}
