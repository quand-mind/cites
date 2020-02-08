<?php

use Faker\Generator as Faker;

$factory->define(App\Page::class, function (Faker $faker) {
    return [
        'meta_description' => $faker->text($maxNbChars = 150),
        'meta_keywords' => $faker->words($nb = 20, $variableNbWords= true),
        'content' => $faker->realText($maxNbChars = 200),
        'is_active' => true,
        'is_static' => true,
        'created_by' => 1,
        'lastModified_by' => 1
    ];
});
