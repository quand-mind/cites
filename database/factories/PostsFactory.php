<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->realText($maxNbChars = 50, $indexSize = 1),
        'publish_date' => $faker->dateTime($max = 'now', $timezone = null),
        'user_id' => rand(3, 8),
        'img_id' => rand(1, 20),
        'content' => $faker->realText($maxNbChars = 300, $indexSize = 2)
    ];
});
