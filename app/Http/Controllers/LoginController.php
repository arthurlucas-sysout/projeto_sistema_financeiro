<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email:rfc'],
            'password' => ['required']
        ], [
            'email.required' => 'O campo email é obrigatório!',
            'email.email' => 'E-mail inválido',
            'password.required' => 'A senha é obrigatória',
        ]);

        if (Auth::attempt($credenciais, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); //redireciona o usuário para a página onde o usuário tentou acessar antes de fazer login
        }

        return redirect()->back()->with('erro', 'Login ou senha inválidos');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/home');
    }
}
