<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Category::class, function (Faker $faker) {  // lembra e definir o model
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'slug' => $faker->slug,
    ];
});
