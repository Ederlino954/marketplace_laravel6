<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\http\requests\ProductRequest; // regras de validações
use App\Http\Requests\ProductRequestUpdate;
use App\Traits\UploadTrait;
use App\Classes\Enc;

class AdminProductController extends Controller
{
    use UploadTrait;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index() // lista os dados
    {
        $user = auth()->user();

        if(!$user->store()->exists()) {
            flash('É preciso cria uma loja para cadastrar produtos!
            Produtos inacessíveis no momento!')->warning();
            return redirect()->route('admin.stores.index');
        }

        $products = $user->store->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    public function create() // criar os forms
    {
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    public function store(ProductRequest $request) // procesamento da criação //ProductRequest = regras de validações sendo usadas
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

        $data['price'] = formatPriceToDatabase($data['price']);

        $store = auth()->user()->store;
        $product = $store->products()->create($data);

        $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
        }

        flash('Produto Criado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function show($id) // visualização específica
    {
        return $id;
    }

    public function edit($idEncProduct) // edição
    {
        // dd($idEncProduct);
        $product = Enc::desencriptar($idEncProduct);
        $product = $this->product->findOrFail($product); //findOrFail caso produto não exista
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(ProductRequestUpdate $request, $product)  // atualização //ProductRequest = regras de validaões sendo usadas
    {
        // dd($product);
        $data = $request->all();
        $categories = $request->get('categories', null);

        $product = $this->product->find($product);
        $product->update($data);

        if (!is_null($categories))
            $product->categories()->sync($categories);

        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');

            $product->photos()->createMany($images);
        }

        flash('Produto Atualizado com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

    public function destroy($idEncProduct) // deletar
    {
        // dd($idEncProduct);
        $product = Enc::desencriptar($idEncProduct);

        $product = $this->product->find($product);
        $product->delete();

        flash('Produto Removido com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

}
