<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use APP\UserRole;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function index(Request $request) // Buscar todos os usuários
    {
        $pages = $request->integer('limit', 10);

        $users = User::paginate($pages);

        return view('users.index', compact('users'));
    }


    public function create(Request $request)
    {
        $user = new User();

        return view('users.create', compact('user'));
    }


    public function store(Request $request) // Criar um usuário
    {
        $user = $this->validation($request);
        User::create($user);

        return redirect()->route('users.index')->with('sucess', 'Cadastro realizado com sucesso!');
    }


    public function show(int $id) // Buscar um usuário por id
    {
        $user = User::findOrFail($id);

        return view('users.create', compact('user'));
    }


    public function edit(int $id) // Exibir tela de edição
    {

        $user = User::findOrFail($id);


        $this->authorize('delete', $user);

        if (!$user)
            return view('users.create')->with('danger', 'Usuário não encontrado!');

        return view('users.create', compact('user'));
    }


    public function update(Request $request, int $id) // Atualizar um usuário conforme um id
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $validated = $this->validation($request, $id);

        if (empty($validated['password'])) // empty verifica se é null, "", vazio
            unset($validated['password']); //remove o campo password antes de salvar e quando o método update for chamado, a senha do banco permanece

        $user->update($validated);

        return redirect()->route('users.index')->with('sucess', 'Usuário atualizado com sucesso!');
    }


    public function destroy(int $id) // Deletar um usuário conforme um id
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        $user->delete();

        if(auth()->user()->role === UserRole::ADMIN)
        return redirect()->route('users.index')->with('sucess', 'Usuário deletado com sucesso!');

        return redirect('home');
    }


    private function validation(Request $request, int $id = null)
    {
        $uniqueEmail = Rule::unique('users', 'email');
        $uniquePhone = Rule::unique('users', 'phone');

        if ($request->id) {
            $uniqueEmail ->ignore($id);
            $uniquePhone->ignore($id);
        }

        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:rfc',  $uniqueEmail],
            'password' => [$id ? 'nullable' : 'required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['required', $uniquePhone, 'regex:/^\(\d{2}\)\s\d{5}\-\d{4}$/'],
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'Nome inválido',
            'name.max' => 'Nome inválido',

            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já cadastrado',

            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.mixed_case' => 'A senha deve ter letras maiúsculas e minúsculas',
            'password.numbers' => 'A senha deve ter pelo menos um número',
            'password.symbols' => 'A senha deve ter pelo menos um caracter especial',

            'phone.required' => 'O telefone é obrigatório',
            'phone.unique' => 'Telefone já cadastrado',
            'phone.regex' => 'O telefone deve estar no formato (XX) 9XXXX-XXXX'
        ]);
    }
}
