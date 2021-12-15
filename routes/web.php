<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model', function () {


    // $products = \App\Product::all(); /// select * from products

    // $user = new \App\User();
    // $user->name = 'Usuário Teste';
    // $user->email = 'email@teste.com';
    // $user->password = bcrypt('12345678');
    // $user->save();

    // return $user->save();



    // $products = \App\Product::all(); /// select * from products
    // Active record permite trabalhar as colunas dos bancos como atributos da classe

    // $user = new \App\User();

    // ------------------------------------
    // $user = \App\User::find(1);
    // $user->name = 'Usuário Teste Editado...'; // Atualizou
    // $user->save();
    // ----------------------------------------------

    // return $user->save();


    // ----------------------------------------
    // return \App\User::all(); // retorna todos os usuarios - retorna em JSON // Collection, coleções de dados
    // return \App\User::find(3); // retorna o suaurio com base no id
    // return \App\User::where('name', 'Aiden Sawayn')->get(); // select * from where name = 'Margarita Larkin'
    // return \App\User::where('name', 'Leora Prohaska')->first(); // retorna somente o primeiro resultado

    // return \App\User::paginate(10); // Paginar dados com laravel

    //------------------------------------------------------

    // Mass Assigment - Atribuição em massa

    // $user = \App\User::create([
    //     'name' => 'Ederlino',
    //     'email' => 'ederlino@gmail.com',
    //     'password' => bcrypt('12345678')
    // ]);
    // dd($user);

    // Mass Update
    // $user = \App\User::find(42);
    // // $user = $user->update([ // retorna true ou false
    // $user->update([ // retorna os valo sem ser boleano, retorn acom os atributos
    //     'name' => 'Atualizando com Mass Update '
    // ]);
    // dd($user);

    return \App\User::all();
});
