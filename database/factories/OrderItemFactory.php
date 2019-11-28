<?php

$factory->define(App\OrderItem::class, function (Faker\Generator $faker) {
    return [
        'order_number' => $faker->unique()->randomNumber,
        'customer_id' => $faker->randomDigitNotNull,
    ];
});
