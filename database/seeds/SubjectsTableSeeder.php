<?php

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
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
            'name' => 'Mathematics',
            'class' => 'IV A',
            'slug' => 'Mathematics-IVA',
          ],
          [
          'name' => 'English',
          'class' => 'II B',
          'slug' => 'English-IIB',
          ]
        ];

        foreach ($arr as $k => $v) {
          factory(Subject::class)->create(['name' => $v['name'], 'class'=>$v['class'], 'slug'=>$v['slug']]);
        }
    }
}
