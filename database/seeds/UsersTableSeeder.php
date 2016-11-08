<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
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
            'email' => 'teacher@gonzaga.ac.tz',
            'name' => 'John Doe',
            'username' => 'johndoe'
          ],
          [
            'email' => 'classteacher@gonzaga.ac.tz',
            'name' => 'Jane Doe',
            'username' => 'janedoe'
          ],
          [
            'email' => 'class@gonzaga.ac.tz',
            'name' => 'Voip Doe',
            'username' => 'voip'
          ],
        ];


          $firstUser = factory(User::class)->create([
              'email' => $arr[0]['email'],
              'name' => $arr[0]['name'],
              'username' => $arr[0]['username'],
          ]);

          $firstUser->makeTeacher('teacher');

          $secondUser = factory(User::class)->create([
              'email' => $arr[1]['email'],
              'name' => $arr[1]['name'],
              'username' => $arr[1]['username'],
          ]);

          $secondUser->makeTeacher('class_teacher');
          $secondUser->makeTeacher('teacher');

          $thirdUser = factory(User::class)->create([
              'email' => $arr[2]['email'],
              'name' => $arr[2]['name'],
              'username' => $arr[2]['username'],
          ]);

          $thirdUser->makeTeacher('class_teacher');
          $thirdUser->makeTeacher('teacher');

    }
}
