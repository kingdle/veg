<?php

use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'summary' => $faker->paragraph,
        'user_id'=>factory(\App\User::class)->create()->id,
        'content' => $faker->paragraph,
        'property' => $faker->numberBetween(1, 20),
        'avatar' => $faker->imageUrl(220,220),
        'pic_count' => $faker->numberBetween(1, 30),
        'dynamic_count' => $faker->numberBetween(1, 20),
        'address' => $faker->address,
        'published_at' => $faker->dateTime,
        'code' => $faker->unique()->postcode
    ];
});
