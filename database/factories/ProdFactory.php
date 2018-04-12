<?php

use Faker\Generator as Faker;

$factory->define(App\Prod::class, function (Faker $faker) {
    return [
        'shop_id' => factory(\App\Shop::class)->create()->id,
        'sort_id' => factory(\App\Sort::class)->create()->id,
        'title' => $faker->sentence,
        'introduce' => $faker->paragraph,
        'pic' => $faker->imageUrl(220,220),
        'unit_prince' =>$faker->numberBetween(1, 5),
        'comments_count' => $faker->numberBetween(1, 20),
        'likes_count' => $faker->numberBetween(1, 30),
        'followers_count' => $faker->numberBetween(1, 20),
        'published_at' => $faker->dateTime
    ];
});
