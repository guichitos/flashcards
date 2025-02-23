<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;

// Grupo de rutas protegidas por autenticación Sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/cards', [CardController::class, 'index']); // Obtener todas las tarjetas del usuario autenticado
    Route::post('/cards', [CardController::class, 'store']); // Crear una tarjeta
    Route::put('/cards/{id}', [CardController::class, 'update']); // Editar una tarjeta
    Route::delete('/cards/{id}', [CardController::class, 'destroy']); // Eliminar una tarjeta
});
