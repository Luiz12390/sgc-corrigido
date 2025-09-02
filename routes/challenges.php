<?php

use App\Http\Controllers\ChallengeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Desafios
|--------------------------------------------------------------------------
*/

Route::get('/desafios', [ChallengeController::class, 'index'])->name('challenges.index');
Route::get('/desafios/exemplo', [ChallengeController::class, 'show'])->name('challenges.show');
