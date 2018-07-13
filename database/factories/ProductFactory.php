<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text(),
        'price' => $faker->randomFloat(2, 12, 3983),
        'availability' => $faker->boolean(),
        'user_id' => $faker->numberBetween(1, 10)
    ];
});
