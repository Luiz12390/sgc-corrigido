<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Exibe o perfil público de um usuário.
     */
    public function show(User $user)
    {
        $user->load('organizations', 'projects');

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
            'title' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'institution' => ['nullable', 'string', 'max:255'],
            'competencies' => ['nullable', 'string', 'max:255'],
            'interests' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            $validatedData['profile_photo_path'] = $request->file('photo')->store('profile-photos', 'public');
        }

        $user->update($validatedData);
        return redirect()->route('profile.show', ['user' => $user])->with('status', 'Perfil atualizado com sucesso!');
    }
}
