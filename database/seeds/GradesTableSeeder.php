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
      // $arr =
      // [
      //   [
      //     'name' => 'IV A',
      //     'subjects' => json_encode(['1','2','3','4','8','6','9','10','11']),
      //     'students' => json_encode(['1','2','3','4','5']),
      //   ],
      //   [
      //     'name' => 'II B',
      //     'subjects' => json_encode(['1','2','3', '4', '8','6']),
      //     'students' => json_encode(['6','7','8','9','10']),
      //   ],
      // ];
      //
      // foreach ($arr as $k => $v) {
      //   factory(Grade::class)->create([
      //     'name' => $v['name'],
      //     'subjects' => $v['subjects'],
      //     'students' => $v['students']
      //   ]);
      // }
      factory(Grade::class)->create([
        'user_id' => 2,
        'name' => 'IV A',
        'subjects' => json_encode(['1','2','3','4','8','6','9','10','11']),
        'students' => json_encode(['1','2','3','4','5']),
      ]);

      factory(Grade::class)->create([
        'user_id' => 3,
        'name' => 'II B',
        'subjects' => json_encode(['1','2','3', '4', '8','6']),
        'students' => json_encode(['6','7','8','9','10']),
      ]);
    }
}
