<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Usuários
|--------------------------------------------------------------------------
*/

Route::get('/perfil/{user}', [UserController::class, 'show'])->name('profile.show');
Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');