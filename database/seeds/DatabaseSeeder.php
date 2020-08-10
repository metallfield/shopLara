<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
       // factory(\App\Product::class, 10000)->create();
        factory(\App\Order::class, 1000)->create()->each(function ($order){
            $order->products()->saveMany(factory(\App\Product::class, 5 )->make());
        });
    }
}
