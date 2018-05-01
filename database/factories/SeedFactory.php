<?php

use Faker\Generator as Faker;

$factory->define(App\Seed::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'title' => str_random(10),
        'property' => '',
        'content' => '',
        'phone' => NULL,
        'web_url' => '',
        'remark' => '',
        'published_at' => $faker->dateTime,
        'code' => NULL
    ];
});
