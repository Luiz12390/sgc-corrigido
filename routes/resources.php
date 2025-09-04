<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Recursos
|--------------------------------------------------------------------------
*/

// Rota para a listagem (index) de recursos
Route::get('/recursos', function () {
    return view('resources.index');
})->name('resources.index');

// Rota de teste para detalhes de um recurso
Route::get('/recursos/exemplo', function () {
    return view('resources.show');
})->name('resources.show');
