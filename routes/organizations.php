<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Organizações
|--------------------------------------------------------------------------
*/

Route::get('/organizacoes', [OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organizacoes/criar', [OrganizationController::class, 'create'])->name('organizations.create')->middleware('auth');
Route::post('/organizacoes', [OrganizationController::class, 'store'])->name('organizations.store')->middleware('auth');
Route::get('/organizacoes/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
Route::get('/organizacoes/{organization}/membros', [OrganizationController::class, 'members'])->name('organizations.members');
Route::get('/organizacoes/{organization}/gerenciar-membros', [OrganizationController::class, 'manageMembers'])->name('organizations.manageMembers');
Route::get('/organizacoes/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
Route::patch('/organizacoes/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');

