<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Store::class, function (Faker $faker) { // criado para teste de criação de lojas
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'phone' => $faker->phoneNumber,
        'mobile_phone' => $faker->phoneNumber,
        'slug' => $faker->slug
    ];
});
