<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cardapio\CardapioController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Reservas\ReservasController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::controller(CardapioController::class)->group(function() {
    Route::get('/cardapio', 'index')->name('cardapio.index');
});

Route::controller(RegisterController::class)->prefix('/register')->group(function() {
    Route::get('/', 'create')->name('register.create');
    Route::post('/', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::post('/logout', 'destroy')->name('login.destroy');
});

Route::middleware('auth')->group(function() {
    Route::controller(UserController::class)->middleware('check.user')->group(function() {
        Route::get('/perfil/{user}', 'show')->name('users.show');
        Route::get('/perfil/{user}/edit', 'edit')->name('users.edit');
        Route::put('/perfil/{user}', 'update')->name('users.update');
        Route::delete('/perfil/{user}', 'destroy')->name('users.destroy');
    });

    Route::controller(ReservasController::class)->group(function() {
        Route::get('/reservas', 'create')->name('reservas.create');
        Route::post('/reservas', 'store')->name('reservas.store');
        Route::get('/reservas/{reserva}/edit', 'edit')->name('reservas.edit');
        Route::put('/reservas/{reserva}', 'update')->name('reservas.update');
        Route::delete('/reservas/{reserva}', 'destroy')->name('reservas.destroy');
    });
});
