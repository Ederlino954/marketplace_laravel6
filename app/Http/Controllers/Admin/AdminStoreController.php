<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\http\requests\StoreRequest; // regras de validações
use App\Http\Requests\StoreRequestUpdate;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class AdminStoreController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store') );
    }

    public function create()
    {

        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request) //StoreRequest = regras de validações sendo usadas
    {
        $data = $request->all();
        $user = auth()->user();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data); // mass assignment

        flash('Loja Criada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreRequestUpdate $request, $store) //StoreRequest = regras de validaões sendo usadas // atualiza
    {
        $data = $request->all();
        $store = \App\Store::find($store);

        if ($request->hasFile('logo')) {
            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }

            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data); // mass assignment

        flash('Loja Atualizada com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete(); // para deletar a loja os productos tem que estar com a opção de deleção CASCADE habilitada no banco de dados

        flash('Loja Removida com sucesso!')->success();
        return redirect()->route('admin.stores.index');
    }



}
