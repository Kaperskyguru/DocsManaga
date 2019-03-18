<?php

use App\Document;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    $cat = $faker->randomElement($array = array('Unknown',
        'Auto & Vehicles',
        'Business & Marketing',
        'Creative',
        'Film & Music',
        'Fun & Entertainment',
        'Hobby & Home',
        'Knowledge & Resources',
        'Nature & Animals',
        'News & Politics',
        'Nonprofits & Activism',
        'Religion & Philosophy',
        'Sports',
        'Technology & Internet',
        'Travel & Events',
        'Weird & Bizarre')
    );
    return [
        'title' => $faker->text(10),
        'description' => $faker->realText(50),
        'category' => $cat,
        'filename' => $faker->url,
        'file' => $faker->name,
        'type' => $faker->fileExtension,
        'user_id' => $faker->numberBetween(1, 50),
        'access' => $faker->numberBetween(1, 2),
    ];
});
