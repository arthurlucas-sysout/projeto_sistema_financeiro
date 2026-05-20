<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{

    public function index(Request $request) // Buscar todos os usuários
    {
        $pages = $request->integer('limit', 10);

        $users = User::paginate($pages);

        return view('users.index', compact('users'));
    }

    public function create() // Exibir tela de criação
    {
        return view('users.create');
    }

    public function store(Request $request) // Criar um usuário
    {
        $user = $this->validation($request);
        User::create($user);

        return redirect('/users')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function show(int $id) // Buscar um usuário por id
    {
        return User::findOrFail($id);
    }

    public function edit(int $id) // Exibir tela de edição
    {
        //
    }

    public function update(Request $request, int $id) // Atualizar um usuário conforme um id
    {
        $user = User::findOrFail($id);

        this->validation($user);

        User::update($user);
    }

    public function destroy(int $id) // Deletar um usuário conforme um id
    {
        $user = User::findOrFail($id);

        $user::delete();
    }

    private function validation(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:rfc', 'unique:users,email'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['required', 'unique:users,phone', 'regex:/^\(\d{2}\)\s\d{5}\-\d{4}$/'],
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'Nome inválido',
            'name.max' => 'Nome inválido',

            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já cadastrado',

            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.mixed' => 'A senha deve ter letras maiúsculas e minúsculas',
            'password.numbers' => 'A senha deve ter pelo menos um número',
            'password.symbols' => 'A senha deve ter pelo menos um caracter especial',

            'phone.required' => 'O telefone é obrigatório',
            'phone.unique' => 'Telefone já cadastrado',
            'phone.regex' => 'O telefone deve estar no formato (XX) 9XXXX-XXXX'
        ]);
    }
}
