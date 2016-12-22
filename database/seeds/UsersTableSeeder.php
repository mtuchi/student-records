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
            'email' => 'john@gonzaga.ac.tz',
            'name' => 'John Doe',
            'username' => 'johndoe',
						'DOB' => '1989-11-12',
		        'gender' => 'm',
		        'phone' => '+255754875676',
          ],
          [
            'email' => 'jane@gonzaga.ac.tz',
            'name' => 'Jane Doe',
            'username' => 'janedoe',
						'DOB' => '1989-09-11',
		        'gender' => 'f',
		        'phone' => '+255754876912',
          ],
          [
            'email' => 'voip@gonzaga.ac.tz',
            'name' => 'Voip Doe',
            'username' => 'voip',
						'DOB' => '1989-01-12',
		        'gender' => 'f',
		        'phone' => '+255754805676',
          ],
					[
						'email' => 'admin@gonzaga.ac.tz',
						'name' => 'School Admin',
						'username' => 'admin',
						'DOB' => '1989-06-09',
		        'gender' => 'm',
		        'phone' => '+255754876876',
					],
        ];


          $firstUser = factory(User::class)->create([
              'email' => $arr[0]['email'],
              'name' => $arr[0]['name'],
              'username' => $arr[0]['username'],
							'DOB' => $arr[0]['DOB'],
			        'gender' => $arr[0]['gender'],
			        'phone' => $arr[0]['phone'],
          ]);

          $firstUser->makeTeacher('teacher');

          $secondUser = factory(User::class)->create([
              'email' => $arr[1]['email'],
              'name' => $arr[1]['name'],
              'username' => $arr[1]['username'],
							'DOB' => $arr[1]['DOB'],
			        'gender' => $arr[1]['gender'],
			        'phone' => $arr[1]['phone'],
          ]);

          $secondUser->makeTeacher('class_teacher');
          $secondUser->makeTeacher('teacher');

          $thirdUser = factory(User::class)->create([
              'email' => $arr[2]['email'],
              'name' => $arr[2]['name'],
              'username' => $arr[2]['username'],
							'DOB' => $arr[2]['DOB'],
			        'gender' => $arr[2]['gender'],
			        'phone' => $arr[2]['phone'],
          ]);

          $thirdUser->makeTeacher('class_teacher');
          $thirdUser->makeTeacher('teacher');

					$fourthUser = factory(User::class)->create([
              'email' => $arr[3]['email'],
              'name' => $arr[3]['name'],
              'username' => $arr[3]['username'],
							'DOB' => $arr[3]['DOB'],
			        'gender' => $arr[3]['gender'],
			        'phone' => $arr[3]['phone'],
          ]);

          $fourthUser->makeTeacher('admin');

    }
}
