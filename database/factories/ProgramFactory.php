<?php

use Faker\Generator as Faker;
use App\Student; 

$factory->define(App\Program::class, function (Faker $faker) {
    return [
        'student_id' => Student::all()->random()->id,
        'product_id' => $faker->numberBetween($min=1, $max=5),
        'created_at' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        'created_by' => $faker->numberBetween($min=1, $max=50)
    ];
});
