<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return redirect()->route('clientes.index');
});

// CRUD completo
Route::resource('clientes', ClientesController::class);

// Ruta adicional para búsqueda por ID
Route::get('/clientes-buscar', [ClientesController::class, 'buscar'])->name('clientes.buscar');
