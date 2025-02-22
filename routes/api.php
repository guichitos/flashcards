<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

// Rutas de la API (sin autenticación)
Route::get('/cards', [CardController::class, 'index']); // Obtener todas las tarjetas
Route::post('/cards', [CardController::class, 'store']); // Crear una tarjeta
Route::delete('/cards/{id}', [CardController::class, 'destroy']); // Eliminar una tarjeta
Route::put('/cards/{id}', [CardController::class, 'update']);
