@extends('layouts.app')

    @section('content')

        @if (!$store)
            <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Criar Loja</a>
        @else
            <div class="card shadow-lg p-3 mb-5 mt-3 bg-body rounded">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Loja</th>
                            <th>Total de Produtos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>{{ $store->id }}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->products->count() }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.stores.edit', ['store' => $store->id ]) }}"   class="btn btn-sm btn-primary">EDITAR</a>
                                    <form action="{{ route('admin.stores.destroy', ['store' => $store->id ]) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" onclick="return confirm('Deseja realmente remover esta loja?')" class="btn btn-sm btn-danger">Remover</button>
                                        {{-- produto linkado a loja esta com casade habilitado no banco para não dar erro em caso de deleção --}}
                                    </form>
                                </div>

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        @endif

    @endsection
