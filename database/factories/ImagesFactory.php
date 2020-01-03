<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    $arr = [];
    for ($i = 1; $i <= 20; $i++) {
        array_push($arr, $i);
    }

    return [
        'author' => $faker->name(),
        'date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'alt_img' => 'my image',
        'url' => $faker->image(null, $width = 920, $height = 1080, 'cats', false), // '13b73edae8443990be1aa8f1a483bc27.jpg' it's a filename without path
        'post_id' => $faker->randomElement($arr)
    ];
});
