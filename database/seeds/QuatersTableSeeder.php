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
          'slug' =>'first_quater'
        ],
        [
          'name' => 'Second Quater',
          'live' => true,
          'slug' =>'second_quater'
        ],
        [
          'name' => 'Third Quater',
          'live' => true,
          'slug' =>'third_quater'

        ],
        [
          'name' => 'Fourth Quater',
          'live' => false,
          'slug' =>'fourth_quater'
        ],
      ];
      foreach ($arr as $k => $v) {
        factory(Quater::class)->create(['name' => $v['name'], 'live'=>$v['live'], 'slug'=>$v['slug']]);
      }
    }
}
