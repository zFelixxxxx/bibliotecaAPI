<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AutorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;

Route::apiResource('autores', AutorController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('editoriales', EditorialController::class);
Route::apiResource('libros', LibroController::class);
Route::apiResource('prestamos', PrestamoController::class);