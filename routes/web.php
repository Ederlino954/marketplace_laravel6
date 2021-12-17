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


Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::prefix('stores')->group(function(){
        Route::get('/', 'StoreController@index');
        Route::get('/create', 'StoreController@create');
        Route::post('/store', 'StoreController@store');
        Route::get('/{store}/edit', 'StoreController@edit');
        Route::post('/update/{store}', 'StoreController@update');
    });
});




//Route::get  // pega
//Route::post // cria
//Route::put  // atualiza
//Route::patch  // atualiza
//Route::delete  // remove
//Route::options // retorna cabeçalhos correspondentes implementados


// -----ROTAS DE TESTE-------//
Route::get('/model', function () {

    // --------------------TESTES-----------------------------//


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


    // ------------------------------------------
    // pegar a loja de um usuário!
    // $user = \App\User::find(4);

    // return $user->store; // o objeto único  (Store) N:N collection de dados(objeto)

    // dd($user->store()); // instancia de hasOne

    // dd($user->store()->count()); //  contando as lojas do usuario
    // -------------------------------------

    // Pegar os produtos de uma loja
    // $loja = \App\Store::find(1);

    // return $loja->products;
    // return $loja->products()->count(); // colletion return
    // return $loja->products()->where('id', 1)->get();
    // dd($loja->products());  // retorn hasMany

    // ---------------------------------------------------------------------------
    // pegar as categorias de uma loja
    // $categoria = \App\Category::find(1);
    // $categoria->products;

    /////============================//=====================================//=======

    // criar uma loja para um usuário
    // $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Loja teste',
    //     'description' => 'Loja teste de produtos de informática',
    //     'mobile_phone' => 'xx-xxxx-xxxx',
    //     'phone' => 'xx-xxxx-xxxx',
    //     'slug' => 'loja-teste'
    // ]);
    // dd($store);

    // ------------------------------------------------------------------------

    // // criar um produto para uma loja

    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //     'description' => 'core I7 16-gigas',
    //     'body' => 'Qualquer coisa...',
    //     'price' => '2999.90',
    //     'slug' => 'notebook-dell',
    // ]);

    // dd($product);

    // ----------------------------------------------------------------------------

    // criar uma categoria

    // \App\category::create([
    //     'name' => 'Games',
    //     'description' => null,
    //     'slug' => 'games'
    // ]);

    /// --------------------------------------------------------------------------------

    // \App\category::create([

    //     'name' => 'Notebooks',
    //     'description' => null,
    //     'slug' => 'notebooks'
    // ]);

    // return \App\Category::all();

    // Adicionar um produto para uma categoria ou vice versa

    // $product = \App\Product::find(41);

    // dd($product->categories()->attach([1])); // ADICONA
    // $product->categories()->attach([1]); // ADICONA
    // $product->categories()->detach([1]); // REMOVE
    // dd($product->categories()->sync([1,2])); // adiconou 2
    // dd($product->categories()->sync([2])); // manteve a 2 e removeu a cat 1

    // -------------------------------------------------------------

    $products = \App\Product::find(41);

    // return $products;
    return $products->categories;

});
