<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'DOB' => '1989-12-12',
        'gender' => 'm',
        'phone' => '+255754876876',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Subject::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Mathematics',
    ];
});


$factory->define(\App\Models\Quarter::class, function (Faker\Generator $faker) {

    return [
        'name' => 'First quarter',
        'live' => true,
        'slug' => 'first_quarter'
    ];
});

$factory->define(\App\Models\Student::class, function (Faker\Generator $faker) {
	$gender = $faker->boolean ? 'f':'m';

	if($gender == 'f') {
		return [
			'name' =>  $faker->firstNameFemale . " " . $faker->lastName,
			'gender' => $gender
		];
	}

	return [
		'name' => $faker->firstNameMale . " " . $faker->lastName,
		'gender' => $gender
	];
});

$factory->define(\App\Models\Score::class, function (Faker\Generator $faker) {

  return [
    'student_id' => 1,
    'quarter_id' => 1,
    'subject_id' => 1,
    'first_month'=> $faker->randomNumber($nbDigits = 2),
    'second_month' => $faker->randomNumber($nbDigits = 2),
    'third_month' => $faker->randomNumber($nbDigits = 2),
  ];
});

$factory->define(\App\Models\Attendance::class, function (Faker\Generator $faker) {

  return [
    'student_id' => 1,
    'quarter_id' => 1,
    'grade_id' => 1,
    'first_month'=> $faker->randomNumber($nbDigits = 2),
    'second_month' => $faker->randomNumber($nbDigits = 2),
    'third_month' => $faker->randomNumber($nbDigits = 2),
  ];
});

$factory->define(\App\Models\Grade::class, function (Faker\Generator $faker) {

  return [
    'user_id' => 2,
    'name' => 'IV A',
    'slug' => 'IV-A',
    'subjects' => json_encode(['1','2','3','4','8','6','9','10','11']),
    'students' => json_encode(['1','2','3','4','5']),
  ];
});

$factory->define(\App\Models\Teacher::class, function () {

  return [
    'user_id' => 1,
    'grade_id' => 1,
    'subject_id' => 1,
    'slug' => 'Mathematics-IVA',
  ];
});
