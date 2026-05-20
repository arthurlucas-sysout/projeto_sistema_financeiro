@extends('layouts.layout')

@section('content')

<h1> Listagem de usuários</h1>

    @include('components.flash-message')

<table>

    @if ($users)
        <form action="/users" method="POST"></form>
    @endif

    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
        </tr>
    </thead>

    <tbody>
        @if ($users)
            @foreach ($users as $user)
            <tr>
                <td> {{ $user->name }} </td>
                <td>{{ $user->email }} </td>
                <td> {{ $user->phone }} </td>
            </tr>
            @endforeach

        @else

        <h2>Nenhum usuário cadastrado</h2>

        @endif

    </tbody>
</table>
@endsection
