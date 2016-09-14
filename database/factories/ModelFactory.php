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
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(\App\Models\Subject::class, function (Faker\Generator $faker) {

    return [
        'name' => 'Mathematics',
        'class' => 'IV A',
        'slug' => 'Mathematics-IVA',
        'user_id' => 1
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
