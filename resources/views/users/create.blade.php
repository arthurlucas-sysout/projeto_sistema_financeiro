@extends('layouts.layout')

@section('content')

<h2>Cadastrar usuário</h2>

<form action="/users" method="POST">

    <label for="name">Nome: </label>
    <br>
    <input type="text" name="name" id="name" placeholder="Digite o nome" required min="3" max="255">
    <br>

    <label for="email">E-mail:</label>
    <br>
    <input type="email" name="email" id="email" placeholder="Digite o email" required>
    <br>

    <label for="phone">Telefone:</label>
    <br>
    <input type="text" name="phone" id="phone" placeholder="Digite o seu telefone" min="15" max="15">
    <br>

    <label for="password">Senha:</label>
    <br>
    <input type="password" name="password" id="password" placeholder="Digite a senha" required min="8" max="255">
    <br>

    <button type="submit">Cadastrar</button>

</form>

    @if($mensagem = Session::get('sucesso'))
    <h2>{{ mensagem }}</h2>
    @endif

@endsection