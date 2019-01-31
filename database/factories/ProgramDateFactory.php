<?php

use Faker\Generator as Faker;
use App\Program;

$factory->define(App\ProgramDate::class, function (Faker $faker) {
    return [
        'program_id' => Program::all()->random()->id,
        'start_date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = '+5 months', $timezone = null, $format = 'Y-m-d'),
        'completion_date' => $faker->dateTimeBetween($startDate = '-2 months', $endDate = '+5 months', $timezone = null, $format = 'Y-m-d'),
    ];
});
