<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rotas Web Principais
|--------------------------------------------------------------------------
*/

// Rota da landing page
Route::get('/', function () {
    return view('welcome');
});

// Rota para a página principal (home) após o login
Route::get('/home', function () {
    return view('home');
})->name('home');
