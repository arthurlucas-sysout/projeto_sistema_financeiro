@extends('layouts.layout')

@section('content')

<h2>Cadastrar usuário</h2>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    @endif

<form action="/users" method="POST">
    @csrf

    <label for="name">Nome: </label>
    <br>
    <input type="text" name="name" value="{{ old('name') }}" id="name" placeholder="Digite o nome" required min="3" max="255">
    <br>

    <label for="email">E-mail:</label>
    <br>
    <input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="Digite o email" required min="3" max="255">
    <br>

    <label for="phone">Telefone:</label>
    <br>
    <input type="text" name="phone" value="{{ old('phone') }}" id="phone" placeholder="Digite o seu telefone" required min="15" max="15">
    <br>

    <label for="password">Senha:</label>
    <br>
    <input type="password" name="password" id="password" placeholder="Digite a senha" required min="8" max="255">
    <br>

    <button type="submit">Cadastrar</button>

</form>

@endsection
