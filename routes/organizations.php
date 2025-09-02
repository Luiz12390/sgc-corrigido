<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Organizações
|--------------------------------------------------------------------------
*/

// Rota de teste para perfil de organização
Route::get('/organizacao/exemplo', function () {
    return view('organizations.show');
})->name('organizations.show');

// Rota de teste para listagem de membros da organização
Route::get('/organizacao/exemplo/membros', function () {
    return view('organizations.members');
})->name('organizations.members');
