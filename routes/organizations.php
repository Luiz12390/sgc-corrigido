<?php

use App\Http\Controllers\OrganizationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Organizações
|--------------------------------------------------------------------------
*/

Route::get('/organizacao/{organization}', [OrganizationController::class, 'show'])->name('organizations.show');
Route::get('/organizacao/{organization}/membros', [OrganizationController::class, 'members'])->name('organizations.members');
