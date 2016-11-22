<?php

use Illuminate\Database\Seeder;
use App\Models\Quarter;

class QuartersTableSeeder extends Seeder
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
          'name' => 'First Quarter',
          'live' => true,
          'slug' =>'first_quarter'
        ],
        [
          'name' => 'Second Quarter',
          'live' => true,
          'slug' =>'second_quarter'
        ],
        [
          'name' => 'Third Quarter',
          'live' => true,
          'slug' =>'third_quarter'

        ],
        [
          'name' => 'Fourth Quarter',
          'live' => false,
          'slug' =>'fourth_quarter'
        ],
      ];
      foreach ($arr as $k => $v)
      {
        factory(Quarter::class)->create(['name' => $v['name'], 'live'=>$v['live'], 'slug'=>$v['slug']]);
      }
    }
}
