<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'id' => factory(User::class)->create()->id,
        // 'id' => User::all()->random()->id,
        // 'id' => function () {
        //     return $facker->unique()->numberBetween($min = 1, $max = 50)
        // }
        'status_id' => 1
    ];
});
