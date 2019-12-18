<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'author' => $faker->name(),
        'date' => $faker->dateTime($max = 'now', $timezone = null),
        'label' => $faker->words($nbWords = 6, $variableNbWords = true),
        'alt_img' => 'my image',
        'url' => $faker->imageUrl($width = 920, $height = 500)
    ];
});
