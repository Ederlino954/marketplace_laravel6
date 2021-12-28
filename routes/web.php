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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// -----INÍCIO ROTAS DE TESTE-------//
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
// -----FIM ROTAS DE TESTE-------//


Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->name('admin.')->namespace('admin')->group(function(){

        // Route::prefix('stores')->name('stores.')->group(function(){

        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');

        // });

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'AdminCategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');

        Route::get('orders/my', 'OrdersController@index');
    });

});


Auth::routes();



//Route::get  // pega
//Route::post // cria
//Route::put  // atualiza
//Route::patch  // atualiza
//Route::delete  // remove
//Route::options // retorna cabeçalhos correspondentes implementados


