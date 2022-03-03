@extends('layouts.app')

    @php
        $enc = new App\Classes\Enc();
    @endphp

    @section('content')

        <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Criar Produto</a>

        <Table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Loja</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr>
                        {{-- {{dd($p->id)}} --}}
                        <td>{{$p->id}}</td>
                        <td>{{$p->name}}</td>
                        <td>R$ {{number_format($p->price, 2, ',', '.')}}</td>
                        <td>{{$p->store->name}}</td>
                        <td>
                            <div class="btn-group">
                                {{-- <a href="{{ route('admin.products.edit', ['product' => $p->id] )}}" class="btn btn-sm btn-primary">EDITAR</a> --}}
                                <a href="{{ route('admin.products.edit', [$enc->encriptar($p->id)] )}}" class="btn btn-sm btn-primary">EDITAR</a>
                                <form action="{{ route('admin.products.destroy', [$enc->encriptar($p->id)] )}}" method="post" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Deseja realmente remover este produto?')"  class="btn btn-sm btn-danger">REMOVER</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </Table>

        {{$products->links()}}

    @endsection
