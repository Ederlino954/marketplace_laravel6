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
        $this->call(UsersTableSeeder::class); // CRIA LOJA COM USUARIOS
        // $this->call(StoreTableSeeder::class); 
        // USAR QUANDO ESTIVER JÁ CRIADO AS LOJAS,
        // ELA CRIA PRODUTOS ASSOCIADOS A MESMA
    }
}
