<?php

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

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
				switch ($grade->name) {
					case 'Pre':
						$subjects = Subject::whereIn('id', $Pre)->get();
						$grade->subject()->attach($Pre);
						# pull subjects
						foreach ($subjects as $subject) {
							# firstOrCreate subject records in teachers table without teacher record
							$teacher = Teacher::firstOrCreate([
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$grade->slug
							]);
							$teacher->grade()->attach($grade->id);
						}

						break;
					case 'I':
					$subjects = Subject::whereIn('id', $I)->get();
					$grade->subject()->attach($I);

					foreach ($subjects as $subject) {
						$teacher = Teacher::firstOrCreate([
							'grade_id' => $grade->id,
							'subject_id' => $subject->id,
							'slug' => $subject->name."-".$grade->slug
						]);
						$teacher->grade()->attach($grade->id);

					}
						break;
					case 'II':
					$subjects = Subject::whereIn('id', $II)->get();
					$grade->subject()->attach($II);

					foreach ($subjects as $subject) {
						$teacher = Teacher::firstOrCreate([
							'grade_id' => $grade->id,
							'subject_id' => $subject->id,
							'slug' => $subject->name."-".$grade->slug
						]);
						$teacher->grade()->attach($grade->id);

					}
						break;
					case 'III':
						$subjects = Subject::whereIn('id', $III)->get();
						$grade->subject()->attach($III);

						foreach ($subjects as $subject) {
							$teacher = Teacher::firstOrCreate([
								'grade_id' => $grade->id,
								'subject_id' => $subject->id,
								'slug' => $subject->name."-".$grade->slug
							]);
							$teacher->grade()->attach($grade->id);

						}
						break;

					default:
						return;
						break;
				}
			}
    }
}
