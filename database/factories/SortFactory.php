<?php

use Faker\Generator as Faker;

$factory->define(App\Sort::class, function (Faker $faker) {
    return [
        'parent_id' => $faker->numberBetween(1, 20),
        'title' => $faker->colorName,
        'icon' => $faker->imageUrl(85,85),
        'hot' => $faker->numberBetween(1, 20)
    ];
});
