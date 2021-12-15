<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'body' => $faker->paragraph(5, true), // true retorna como string
        'price' => $faker->randomFloat(2, 1, 10),
        'slug' => $faker->slug,
    ];
});
