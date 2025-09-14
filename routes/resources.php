<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResourceController;


/*
|--------------------------------------------------------------------------
| Rotas de Recursos
|--------------------------------------------------------------------------
*/

Route::resource('recursos', ResourceController::class)->middleware('auth');
