@extends('layouts.layout')

@section('content')

    <h1> Listagem de usuários</h1>

    @include('components.flash-message')

    <table>
        @include('components.errors')
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @if ($users)
                @foreach ($users as $user)
                    <tr>
                        <td> {{ $user->name }} </td>
                        <td>{{ $user->email }} </td>
                        <td> {{ $user->phone }} </td>

                        <td>
                            <a href="{{ url('/users/' . $user->id . '/edit') }}">
                                <button>Atualizar</button>
                            </a>

                            <form action="{{ url("/users/$user->id") }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="imput">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <h2>Nenhum usuário cadastrado!</h2>
            @endif
        </tbody>
    </table>

    <br>
    <a href="/users/create">Cadastrar Usuário</a>
@endsection
