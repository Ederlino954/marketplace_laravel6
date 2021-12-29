@extends('layouts.app')

    @section('content')

        <a href="{{ route('admin.notifications.read.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas!</a>

        <Table class="table table-striped">
            <thead>
                <tr>
                    <th>Notificaçao</th>
                    <th>Criado em</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($unreadNotifications as $n)
                    <tr>
                        <td>{{$n->data['message']}}</td>
                        {{-- <td>{{$n->created_at->format('d/m/Y H:i:s')}}</td> --}}
                        <td>{{$n->created_at->locale('pt')->diffForHumans()}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-primary">Marcar como lida</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </Table>

    @endsection
