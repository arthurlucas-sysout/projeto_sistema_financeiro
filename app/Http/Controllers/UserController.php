<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use APP\UserRole;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

/**
 * Controller do usuário contendo os métodos index, create, store, show, edit, update e destroy
 *
 * @author Arthur Lucas <arthur.lucas@sysout.com.br>
 * @since 2026-05-28
 */
class UserController extends Controller
{

    /**
     * Método para buscar todos os usuários cadastrados, somente os admins acessam a rota
     *
     * @param Request $request
     *
     * @return Illuminate\View\View
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function index(Request $request)
    {
        $pages = $request->integer('limit', 10);

        $users = User::paginate($pages);

        return view('users.index', compact('users'));
    }


    /**
     * Método que retorna o formulário de criação de usuário
     *
     * @param Request $request
     *
     * @return Illuminate\View\View
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function create(Request $request)
    {
        $user = new User();

        return view('users.create', compact('user'));
    }


    /**
     * Método para a criação do usuário. Recebe os dados do formulário, valida e cria o usuário
     *
     * @param Request $request
     *
     * @return Illuminate\View\View
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function store(Request $request)
    {
        $user = $this->validation($request);

        User::create($user);

        if(auth()->user() && auth()->user()->role === UserRole::ADMIN)
            return redirect()->route('users.index')->with('sucess', 'Usuário criado com sucesso!');

        return view('pages.login.login');
    }


    /**
     * Método para buscar um usuário por id, somente admins podem acessar a rota
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.create', compact('user'));
    }


    /**
     * Método para exibir a tela de edição para o usuário caso seja um id válido
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user);

        return view('users.create', compact('user'));
    }


    /**
     * Método para atualizar um usuário conforme um id
     *
     * @param Request $request
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user); //método da classe UserPolicy

        $validated = $this->validation($request, $id);

        if (empty($validated['password'])) // empty verifica se é null, "", vazio
            unset($validated['password']); //remove o campo password antes de salvar e quando o método update for chamado, a senha do banco permanece

        $user->update($validated);

        return redirect()->route('users.index')->with('sucess', 'Usuário atualizado com sucesso!');
    }


    /**
     * Método para deletar um usuário conforme um id
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse
     * @author Arthur Lucas <arthur.lucas@sysout.com.br>
     * @since 2026-05-28
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        $this->authorize('delete', $user); // método da classe UserPolicy

        $user->delete();

        if(auth()->user()->role === UserRole::ADMIN)
            return redirect()->route('users.index')->with('sucess', 'Usuário deletado com sucesso!');

        return redirect()->route('login.logout');
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
