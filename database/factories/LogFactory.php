<?php

use App\Log;
use Faker\Generator as Faker;

$factory->define(Log::class, function (Faker $faker) {
    $error = $faker->randomElement($array = array('Error', 'Debug', 'Info', 'Warning'));
    return [
        'log' => $faker->text(10),
        'user_id' => $faker->numberBetween(1,50),
        'type' => $error
    ];
});
