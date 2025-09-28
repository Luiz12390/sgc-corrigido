<?php

use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Comunidades
|--------------------------------------------------------------------------
*/

Route::get('/comunidade/criar', [CommunityController::class, 'create'])->name('communities.create');
Route::post('/comunidade', [CommunityController::class, 'store'])->name('communities.store');
Route::get('/comunidade', [CommunityController::class, 'index'])->name('communities.index');
Route::get('/comunidade/{community}', [CommunityController::class, 'show'])->name('communities.show');
Route::get('/comunidade/{community}/manage-members', [CommunityController::class, 'manageMembers'])->name('communities.manageMembers');
