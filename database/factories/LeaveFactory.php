<?php

use Faker\Generator as Faker;
use App\Student;

$factory->define(App\Leave::class, function (Faker $faker) {
    return [
        'leave_type_id' => $faker->numberBetween($min=4, $max=5),
        'student_id' => Student::all()->random()->id,
        'start_date' => $faker->dateTimeBetween($startDate = '-5 months', $endDate = '+5 months', $timezone = null, $format = 'Y-m-d'),
        'completion_date' => $faker->dateTimeBetween($startDate = '-5 months', $endDate = '+5 months', $timezone = null, $format = 'Y-m-d'),
        'created_at' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
        'created_by' => $faker->numberBetween($min=1, $max=50)
    ];
});
