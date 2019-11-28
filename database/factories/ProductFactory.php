<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'size' => '1x1'
    ];
});
