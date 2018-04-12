<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'prod_id' => factory(\App\Prod::class)->create()->id,
        'count'=>$faker->numberBetween(1, 20),
        'price' => $faker->numberBetween(10, 20),
        'name' => $faker->sentence,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'state'=>random_int(0,2),
        'note_buy' => $faker->paragraph,
        'note_sell' => $faker->paragraph
    ];
});
