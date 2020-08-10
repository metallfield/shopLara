<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Order::class, function (Faker $faker) {
    return [
        'name' => function (array $order){
                return \App\User::find($order['user_id'])->name;
        },
        'email' => function (array $order) {
            return \App\User::find($order['user_id'])->email;
        },
        'address' => $faker->text,
        'user_id' => rand(1, 3),
        'status' => rand(0,1)
    ];
});
