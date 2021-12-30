<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\http\requests\ProductRequest; // regras de validações
use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // criar os forms
    {
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request) // procesamento da criação //ProductRequest = regras de validaões sendo usadas
    {
        $data = $request->all();
        $categories = $request->get('categories', null);

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // visualização específica
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product) // edição
    {
        $product = $this->product->findOrFail($product); //findOrFail caso produto não exista
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $product)  // atualização //ProductRequest = regras de validaões sendo usadas
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product) // deletar
    {
        $product = $this->product->find($product);
        $product->delete();

        flash('Produto Removido com sucesso!')->success();
        return redirect()->route('admin.products.index');
    }

}
