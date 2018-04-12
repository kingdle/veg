<?php

use Faker\Generator as Faker;

$factory->define(App\Dynamic::class, function (Faker $faker) {
    return [
        'user_id'=>factory(\App\User::class)->create()->id,
        'content' => $faker->paragraph,
        'pic' => $faker->imageUrl(800,600),
        'published_at' => $faker->dateTime
    ];
});
