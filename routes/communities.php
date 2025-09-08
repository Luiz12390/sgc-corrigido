<?php

use App\Http\Controllers\CommunityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas de Comunidades
|--------------------------------------------------------------------------
*/

Route::get('/comunidade', [CommunityController::class, 'index'])->name('communities.index');


Route::get('/comunidade/exemplo', function () {
    return view('communities.show');
})->name('communities.show');
