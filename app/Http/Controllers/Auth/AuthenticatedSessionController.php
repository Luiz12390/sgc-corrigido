<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Valida os dados do formulário (apenas email e senha são necessários)
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Tenta autenticar o usuário
        if (Auth::attempt($credentials)) {
            // Se a autenticação for bem-sucedida...
            $request->session()->regenerate();

            // 3. Redireciona para a página principal (home)
            return Redirect::route('home'); // Certifique-se de que a rota 'home' existe
        }

        // 4. Se a autenticação falhar, volta para o login com uma mensagem de erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session (logout).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redireciona para a página inicial ou de login após o logout
        return Redirect::to('/');
    }
}
