<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Usuários
|--------------------------------------------------------------------------
*/

Route::get('/meu-perfil-teste', function () {
    return view('users.profile');
})->name('profile');

Route::get('/perfil/{user}', function (User $user) {
    return view('users.profile', ['user' => $user]);
})->name('profile.show');
