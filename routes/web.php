<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Vista protegida para ver tarjetas
    Route::get('/cards', function () {
        return view('cards');
    })->name('cards');
});

Route::get('/cards/{any}', function () {
    return view('cards');
})->where('any', '.*');
