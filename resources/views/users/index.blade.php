@extends('layouts.layout')

@section('content')

<h1> Listagem de usuários</h1>

<table>
    <thead>

        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td> {{ $user->name }} </td>
            <td>{{ $user->email }} </td>
            <td> {{ $user->phone }} </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
