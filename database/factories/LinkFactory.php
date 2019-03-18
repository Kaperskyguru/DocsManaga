<?php

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 50),
        'document_id' => $faker->numberBetween(1, 30),
        'link' => $faker->url,
    ];
});
