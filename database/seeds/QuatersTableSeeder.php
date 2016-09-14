<?php

use Illuminate\Database\Seeder;
use App\Models\Quater;
class QuatersTableSeeder extends Seeder
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
          'name' => 'First Quater',
          'live' => true,
        ],
        [
          'name' => 'Second Quater',
          'live' => true,
        ],
        [
          'name' => 'Third Quater',
          'live' => true,
        ],
        [
          'name' => 'Fourth Quater',
          'live' => false,
        ],
      ];
      foreach ($arr as $k => $v) {
        factory(Quater::class)->create(['name' => $v['name'], 'live'=>$v['live']]);
      }
    }
}
