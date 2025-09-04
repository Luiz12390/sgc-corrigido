<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Comunidades
|--------------------------------------------------------------------------
*/

// Rota para a listagem (index) de comunidades
Route::get('/comunidade', function () {
    return view('communities.index');
})->name('communities.index');

// Rota de teste para a página interna de uma comunidade
Route::get('/comunidade/exemplo', function () {
    return view('communities.show');
})->name('communities.show');
