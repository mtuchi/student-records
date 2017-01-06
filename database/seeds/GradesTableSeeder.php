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
			$grades = ['Pre','I','II','III'];
			$streams = ['A','B'];
			$i = 0;
			foreach ($grades as $grade) {
				foreach ($streams as $stream) {
					$i++;
					if ($i == 1) {
						$firstGrade = factory(Grade::class)->create([
							'user_id' => 2,
							'name' => $grade,
							'stream' => $stream,
			        'slug' => $grade."-".$stream,
			      ]);
						$firstGrade->user()->attach(2);
					}
					elseif ($i == 2) {
						$secondGrade = factory(Grade::class)->create([
							'user_id' => 3,
			        'name' => $grade,
							'stream' => $stream,
			        'slug' => $grade."-".$stream,
			      ]);

						$secondGrade->user()->attach(3);

					} else {
						factory(Grade::class)->create([
							'user_id' => null,
							'name' => $grade,
							'stream' => $stream,
			        'slug' => $grade."-".$stream,
			      ]);
					}

				}
			}
    }
}
