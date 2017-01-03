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
						factory(Grade::class)->create([
							'user_id' => 2,
			        'name' => $grade." ".$stream,
			        'slug' => $grade."-".$stream,
			      ]);
					}
					elseif ($i == 2) {
						factory(Grade::class)->create([
							'user_id' => 3,
			        'name' => $grade." ".$stream,
			        'slug' => $grade."-".$stream,
			      ]);
					} else {
						factory(Grade::class)->create([
							'user_id' => null,
			        'name' => $grade." ".$stream,
			        'slug' => $grade."-".$stream,
			      ]);
					}

				}
			}
    }
}
