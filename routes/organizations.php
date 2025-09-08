<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Organizações
|--------------------------------------------------------------------------
*/

Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index');
Route::get('/organizacao/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
Route::get('/organizacao/{organization}/membros', [OrganizationController::class, 'members'])->name('organizations.members');
Route::get('/organizacao/{organization}/gerenciar-membros', [OrganizationController::class, 'manageMembers'])->name('organizations.manageMembers');
Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
Route::patch('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');

