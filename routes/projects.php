<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Projetos
|--------------------------------------------------------------------------
*/

// Rota para a listagem (index) de projetos
Route::get('/projetos', function () {
    return view('projetos.index');
})->name('projetos.index');

// Rota de teste para detalhes de um projeto
Route::get('/projetos/exemplo', function () {
    return view('projetos.show');
})->name('projetos.show');

// Rota de teste para a página de tarefas de um projeto
Route::get('/projetos/exemplo/tarefas', function () {
    return view('projetos.tasks');
})->name('projetos.tasks');

// Rota de teste para a página de membros de um projeto
Route::get('/projetos/exemplo/membros', function () {
    return view('projetos.members');
})->name('projetos.members');
