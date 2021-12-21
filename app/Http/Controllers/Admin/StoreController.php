<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class StoreController extends Controller
{
    public function index()
    {
        $store = auth()->user()->store; // retornando somente uma loja, controle 1:1

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        if(auth()->user()->store->count()){
            flash('Voce já possui uma loja!')->warning();
            return redirect()->route('admin.stores.index');
        };

        $users = \App\User::all(['id', 'name']); // busca com filtro

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        if(auth()->user()->store->count()){
            flash('Voce já possui uma loja!')->warning();
            return redirect()->route('admin.stores.index');
        };

        $data = $request->all();
        $user = auth()->user();

        $store = $user->store()->create($data); // erro de intellisense, codigo executando/ criando loja para quem está logado!

        flash('Loja criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequest $request, $store)
    {
        $data = $request->all();

        $store = \App\Store::find($store);
        $store->update($data);

        flash('Loja Atualizada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        flash('Loja Removida com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

}
