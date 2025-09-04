<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Exibe o perfil público de um usuário.
     */
    public function show(User $user)
    {
        $user->load('organizations');

        return view('users.profile', ['user' => $user]);
    }

    /**
     * Mostra o formulário para editar o perfil do usuário autenticado.
     */
    public function edit()
    {
        return view('users.edit', [
            'user' => Auth::user(), // Pega o usuário logado
        ]);
    }

    /**
     * Atualiza o perfil do usuário autenticado.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'title' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.show', $user)->with('status', 'Perfil atualizado com sucesso!');
    }
}