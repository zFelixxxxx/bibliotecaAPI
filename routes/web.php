<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [
        App\Http\Controllers\HomeController::class,
        'index'
    ])->name('home');

    Route::view('/autores', 'autores.index')
        ->name('autores.index');

    Route::view('/categorias', 'categorias.index')
        ->name('categorias.index');

    Route::view('/libros', 'libros.index')
        ->name('libros.index');
});