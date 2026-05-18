<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view();
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
    public function show(int $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        this->validation($user);

        User::update($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function validation(Request $request) : Request
    {
        return $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:rfc', 'unique:users.email'],
            'password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'phone' => ['required', 'unique:users.phone']
        ], [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'Nome inválido',
            'name.max' => 'Nome inválido',

            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já cadastrado',

            'password.required' => 'A senha é obrigatória',

            'phone.required' => 'O telefone é obrigatório',
            'phone.unique' => 'Telefone já cadastrado'
        ]);
    }
}