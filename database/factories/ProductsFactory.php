<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'description' => $faker->sentence(),
        'price' => rand(10, 1000),
        'image' => 'images/1595579259.jpeg',
        'count' => rand(1,20),
        'user_id' => rand(1,3),
    ];
});
