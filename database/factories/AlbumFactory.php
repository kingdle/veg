<?php

use Faker\Generator as Faker;

$factory->define(App\Album::class, function (Faker $faker) {
    return [
        'user_id'=>factory(\App\User::class)->create()->id,
        'pic' => $faker->imageUrl(800,600)
    ];
});
