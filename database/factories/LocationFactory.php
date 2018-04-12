<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'name' => $faker->sentence,
        'phone' => $faker->phoneNumber,
        'region' => $faker->city,
        'address' => $faker->address,
        'is_default'=>random_int(0,1)
    ];
});
