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

    return \App\User::all();
});
