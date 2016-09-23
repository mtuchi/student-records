<?php

use Illuminate\Database\Seeder;
use App\Models\Grade;
class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $arr =
      [
        [
          'name' => 'IV A',
          'subjects' => json_encode(['1','2']),
          'students' => json_encode(['1','2','3','4','5']),
        ],
        [
          'name' => 'II B',
          'subjects' => json_encode(['1','2']),
          'students' => json_encode(['6','7','8','9','10']),
        ],
      ];
      
      foreach ($arr as $k => $v) {
        factory(Grade::class)->create([
          'name' => $v['name'],
          'subjects' => $v['subjects'],
          'students' => $v['students']
        ]);
      }
    }
}
