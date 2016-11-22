<?php

use Illuminate\Database\Seeder;
use App\Models\Month;

class MonthsTableSeeder extends Seeder
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
          'quarter' => 1,
          'name' => ['January', 'February', 'March'],
        ],

        [
          'quarter' => 2,
          'name' => ['April', 'May',' June']
        ],
        [
          'quarter' => 3,
          'name' => ['July', 'August', 'September'],
        ],
        [
          'quarter' => 4,
          'name' => ['October', 'November', 'December']
        ]
      ];

      foreach ($arr as $value)
      {
        foreach ($value['name'] as $month)
        {
          Month::firstOrCreate([
            'quarter_id' => trim($value['quarter']),
            'name' => trim($month)
          ]);
        }
      }
    }
}
