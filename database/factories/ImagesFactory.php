<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        'author' => $faker->name(),
        'date' => $faker->dateTime($max = 'now', $timezone = null),
        'alt_img' => 'my image',
        'url' => $faker->image(null, $width = 920, $height = 1080, 'cats', false) // '13b73edae8443990be1aa8f1a483bc27.jpg' it's a filename without path
    ];
});
