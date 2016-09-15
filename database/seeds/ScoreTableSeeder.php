<?php

use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arr = [
        [
          'first_month'=> 49,
          'second_month' => 45,
          'third_month' => 95,
        ],
        [
          'first_month'=> 56,
          'second_month' => 49,
          'third_month' => 80,
        ]
      ];

      foreach ($arr as $k => $v) {
        factory(Score::class)->create([
          'first_month' => $v['first_month'],
          'second_month'=> $v['second_month'],
          'third_month' => $v['third_month']
        ]);
      }
    }
}
