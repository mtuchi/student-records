<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
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
          'name' => 'Cameron, Douglas',
          'gender' => 'm',
        ],
        [
          'name' => 'Cannon, John',
          'gender' => 'm',
        ],
        [
          'name' => 'Card, J. C',
          'gender' => 'm',
        ],
        [
          'name' => 'Bond, Jesse',
          'gender' => 'f',
        ],
        [
          'name' => 'Bösenhofer, Markus',
          'gender' => 'm',
        ],
        [
          'name' => 'Buckley, Robert',
          'gender' => 'm',
        ],
        [
          'name' => 'Edwards, David',
          'gender' => 'm',
        ],
        [
          'name' => 'Fredenslund, Aage',
          'gender' => 'm',
        ],
        [
          'name' => 'Eiseman, Mike',
          'gender' => 'f',
        ],
        [
          'name' => 'Elgohary, Amal',
          'gender' => 'f',
        ],
      ];

      foreach ($arr as $k => $v)
      {
        factory(Student::class)->create(['name' => $v['name'], 'gender'=>$v['gender']]);
      }
    }
}
