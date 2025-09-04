<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Projetos
|--------------------------------------------------------------------------
*/

// Rota para a listagem (index) de projetos
Route::get('/projetos', function () {
    return view('projects.index');
})->name('projects.index');

// Rota de teste para detalhes de um projeto
Route::get('/projetos/exemplo', function () {
    return view('projects.show');
})->name('projects.show');

// Rota de teste para a página de tarefas de um projeto
Route::get('/projetos/exemplo/tarefas', function () {
    return view('projects.tasks');
})->name('projects.tasks');

// Rota de teste para a página de membros de um projeto
Route::get('/projetos/exemplo/membros', function () {
    return view('projects.members');
})->name('projects.members');
