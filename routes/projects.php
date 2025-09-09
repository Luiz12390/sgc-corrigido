<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Projetos (ORDEM CORRIGIDA)
|--------------------------------------------------------------------------
*/

Route::get('/projetos', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projetos/criar', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projetos', [ProjectController::class, 'store'])->name('projects.store');


Route::controller(ProjectController::class)->group(function () {
    // READ (Detalhes)
    Route::get('/projetos/{project}', 'show')->name('projects.show');

    // UPDATE
    Route::get('/projetos/{project}/editar', 'edit')->name('projects.edit');
    Route::put('/projetos/{project}', 'update')->name('projects.update');

    // DELETE
    Route::delete('/projetos/{project}', 'destroy')->name('projects.destroy');

    // Membros
    Route::get('/projetos/{project}/membros', 'members')->name('projects.members');
    Route::get('/projetos/{project}/tarefas', [ProjectController::class, 'tasks'])->name('projects.tasks');
    Route::get('/projetos/{project}/gerir-membros', [ProjectController::class, 'manageMembers'])->name('projects.manageMembers');

});
