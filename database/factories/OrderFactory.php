<?php

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'order_number' => $faker->unique()->randomNumber,
        'customer_id' => $faker->randomDigitNotNull,
    ];
});
