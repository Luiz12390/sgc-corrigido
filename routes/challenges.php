<?php

use App\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Desafios
|--------------------------------------------------------------------------
*/

Route::get('/desafios', [ChallengeController::class, 'index'])->name('challenges.index');
Route::get('/desafios/criar', [ChallengeController::class, 'create'])->name('challenges.create');
Route::post('/desafios', [ChallengeController::class, 'store'])->name('challenges.store');
Route::get('/desafios/{challenge}', [ChallengeController::class, 'show'])->name('challenges.show');
