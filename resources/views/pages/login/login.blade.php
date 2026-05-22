<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    @include('components.flash-message')

    <form action="{{ url('/auth') }}" method="POST">

        <label for="email">Login:</label>
        <br>
        <input type="email" name="email" id="email" placeholder="Digite o email" required min="3" max="255">
        <br>

        <label for="password">Senha:</label>
        <br>
        <input type="password" name="password" id="password" placeholder="Digite a senha" min="8" max="255">
        <br>

        <button type="submit">Login</button>

        <br>
        <a href="/users/create">Não possui cadastro? Registre-se</a>

    </form>

</body>
</html>
