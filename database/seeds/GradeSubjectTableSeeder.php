<?php

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Subject;

class GradeSubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			$grades = Grade::all();
			$Pre = ['2','1','3','4','5','6','7'];
			$I = ['2','1','3','4','8','6'];
			$II = ['2','1','3','4','8','6'];
			$III = ['2','1','3','4','8','6','9','10','11'];


			foreach ($grades as $grade) {
				# get the grade name
				$name = $grade->slug;
				$name = explode('-',$name);

				switch ($name[0]) {
					case 'Pre':
						$subjects = Subject::whereIn('id', $Pre)->get();
						$grade->subject()->attach($Pre);
						# pull subjects
						foreach ($subjects as $subject) {
							# firstOrCreate subject records in teachers table without teacher record
							$grade->teacher()->firstOrCreate([
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$grade->slug
							]);
						}

						break;
					case 'I':
					$subjects = Subject::whereIn('id', $I)->get();
					$grade->subject()->attach($I);

					foreach ($subjects as $subject) {
						$grade->teacher()->firstOrCreate([
							'grade_id' => $grade->id,
							'subject_id' => $subject->id,
							'slug' => $subject->name."-".$grade->slug
						]);
					}
						break;
					case 'II':
					$subjects = Subject::whereIn('id', $II)->get();
					$grade->subject()->attach($II);

					foreach ($subjects as $subject) {
						$grade->teacher()->firstOrCreate([
							'grade_id' => $grade->id,
							'subject_id' => $subject->id,
							'slug' => $subject->name."-".$grade->slug
						]);
					}
						break;
					case 'III':
						$subjects = Subject::whereIn('id', $III)->get();
						$grade->subject()->attach($III);

						foreach ($subjects as $subject) {
							$grade->teacher()->firstOrCreate([
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$grade->slug
							]);
						}
						break;

					default:
						return;
						break;
				}
			}
    }
}
