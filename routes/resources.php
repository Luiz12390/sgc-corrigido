<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Recursos
|--------------------------------------------------------------------------
*/

// Rota para a listagem (index) de recursos
Route::get('/recursos', function () {
    return view('recursos.index');
})->name('recursos.index');

// Rota de teste para detalhes de um recurso
Route::get('/recursos/exemplo', function () {
    return view('recursos.show');
})->name('recursos.show');
