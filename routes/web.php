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
    Route::get('/clientes/verificar', [\App\Http\Controllers\ClienteController::class, 'verificar'])->name('clientes.verificar');
    Route::post('/clientes/comprobar', [\App\Http\Controllers\ClienteController::class, 'comprobar'])->name('clientes.comprobar');
    Route::get('/clientes/fraude', [\App\Http\Controllers\ClienteController::class, 'fraude'])->name('clientes.fraude');
    Route::get('/movimientos/reporte', [\App\Http\Controllers\MovimientoController::class, 'reporte'])->name('movimientos.reporte');
    Route::resource('/movimientos', \App\Http\Controllers\MovimientoController::class)->names('movimientos');
    Route::get('/incidencias/reporte', [\App\Http\Controllers\IncidenciaController::class, 'reporte'])->name('incidencias.reporte');
    Route::resource('/incidencias', \App\Http\Controllers\IncidenciaController::class)->names('incidencias');
    Route::resource('/expedientes', \App\Http\Controllers\ExpedienteController::class)->names('expedientes');
    Route::get('/bd', [\App\Http\Controllers\BdController::class, 'index'])->name('bd.index');
    Route::post('/bd/restore', [\App\Http\Controllers\BdController::class, 'restore'])->name('bd.restore');
    Route::post('/bd/backup', [\App\Http\Controllers\BdController::class, 'backup'])->name('bd.backup');
});
