@extends('layouts.app')

@php
    $enc = new App\Classes\Enc();
@endphp

@section('content')

    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>

    <div class="card shadow-lg p-3 mb-5 mt-3 bg-body rounded">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td >{{$category->id}}</td>
                        <td >{{$category->name}}</td>
                        <td width="15%">
                            <div class="btn-group">
                                {{-- <a href="{{route('admin.categories.edit', ['category' => $category->id])}}" class="btn btn-sm btn-primary">EDITAR</a> --}}
                                <a href="{{route('admin.categories.edit', [$enc->encriptar($category->id)] )}}" class="btn btn-sm btn-primary">EDITAR</a>
                                <form action="{{route('admin.categories.destroy', [$enc->encriptar($category->id)] )}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente remover esta categoria?')">REMOVER</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
