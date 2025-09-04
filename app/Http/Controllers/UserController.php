<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Exibe o perfil de um usuário específico.
     */
    public function show(User $user)
    {
        return view('users.profile', [
            'user' => $user
        ]);
    }
}