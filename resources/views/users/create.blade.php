@extends('layouts.layout')

@section('content')

    <h2>Cadastro de usuário</h2>

    @include('components.errors')

    <form action="{{ $user->id ? url('users/' . $user->id) : url('/users') }}" method="POST">
        @csrf

        @if ($user->id)
            @method('PUT')
        @endif

        <label for="name">Nome: </label>
        <br>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" placeholder="Digite o nome" required
            min="3" max="255">
        <br>

        <label for="email">E-mail:</label>
        <br>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" id="email" placeholder="Digite o email"
            required min="3" max="255">
        <br>

        <label for="phone">Telefone:</label>
        <br>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" id="phone" placeholder="Digite o seu telefone"
            required min="15" max="15">
        <br>

        <label for="password">Senha:</label>
        <br>
        <input type="password" name="password" id="password" placeholder="Digite a senha" {{ !$user->password ? 'required' : '' }} min="8" max="255">
        <br>

        <button type="submit">Cadastrar</button>
    </form>

    <br>
    <a href="/users">Voltar</a>
@endsection
