<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        $user->load('organizations', 'projects');

        return view('users.profile', ['user' => $user]);
    }

    public function edit()
    {
        return view('users.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function security(Request $request)
    {
        return view('users.security');
    }

    public function updatePassword(Request $request)
    {

        $validated = $request->validate([
            'current_password' => ['bail', 'required', 'current_password:web'],

            'password' => ['required', Password::defaults(), 'confirmed', 'different:current_password'],
        ], [
            'current_password.current_password' => 'A senha atual fornecida está incorreta.',
            'password.different' => 'A nova senha deve ser diferente da senha atual.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

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

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password:web'],
        ], [
            'password.current_password' => 'A senha fornecida está incorreta.',
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('auth.register');
    }
}
