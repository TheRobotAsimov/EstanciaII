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
    Route::resource('/users', \App\Http\Controllers\UserController::class)->names('users');
    Route::resource('/movimientos', \App\Http\Controllers\MovimientoController::class)->names('movimientos');
});
