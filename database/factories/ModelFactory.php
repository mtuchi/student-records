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
		$gender = $faker->boolean ? 'f':'m';

    return [
        'name' => $faker->name,
        'username' => $faker->username,
        'email' => $faker->safeEmail,
        'DOB' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = date_default_timezone_get()),
        'gender' => $gender,
        'phone' => $faker->e164PhoneNumber,
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
			'gender' => $gender,
			'dob' => $faker->dateTimeBetween($startDate = '-15 years', $endDate = 'now', $timezone = date_default_timezone_get()),
			'guardian' => $faker->name($gender = null|'male'|'female'),
			'emergency_contact' => $faker->e164PhoneNumber,
		];
	} else{

		return [
			'name' => $faker->firstNameMale . " " . $faker->lastName,
			'gender' => $gender,
			'dob' => $faker->dateTimeBetween($startDate = '-15 years', $endDate = 'now', $timezone = date_default_timezone_get()),
			'guardian' => $faker->name,
			'emergency_contact' => $faker->e164PhoneNumber,
		];
	}

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

	$grade = $faker->randomElement($array = array ('Pre','I','II','III','IV','V','VI','VII'));
	$stream = $faker->randomElement($array = array ('A','B'));
  return [
		'user_id' => $faker->randomDigit,
    'name' => $grade." ".$stream,
    'slug' => $grade."-".$stream,
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
