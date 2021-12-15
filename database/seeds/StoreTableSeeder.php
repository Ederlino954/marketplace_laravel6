<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = \App\Store::all(); // ja existe a loja buscando-as e fazendo o loop 

        foreach ($stores as $store)
        {
            $store->products()->save(factory(\App\Product::class)->make());
        }
    }
}
