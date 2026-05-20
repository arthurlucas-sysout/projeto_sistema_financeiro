<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pages = $request->integer('limit', 10);

        $users = User::paginate($pages);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create')->with('sucesso', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($this->validation($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        this->validation($user);

        User::update($user);
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);

        user::delete($id);
    }

    private function validation(Request $request) : Request
    {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:rfc', 'unique:users,email'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['required', 'unique:users,phone', 'regex:/^\(\d{2}\)\s\d{5}\-\d{4}$/']
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'Nome inválido',
            'name.max' => 'Nome inválido',

            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já cadastrado',

            'password.required' => 'A senha é obrigatória',

            'phone.required' => 'O telefone é obrigatório',
            'phone.unique' => 'Telefone já cadastrado',
            'phone.regex' => 'O telefone deve estar no formato (XX) 9XXXX-XXXX'
        ]);
    }
}