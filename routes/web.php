<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReservasController as AdminReserva;
use App\Http\Controllers\Admin\UserController as AdminUser;
use App\Http\Controllers\Admin\CardapioController as AdminCardapio;
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

Route::controller(RegisterController::class)->prefix('/register')->middleware('guest')->group(function() {
    Route::get('/', 'create')->name('register.create');
    Route::post('/', 'store')->name('register.store');
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'create')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.store')->middleware('guest');
    Route::post('/logout', 'destroy')->name('login.destroy');
});

Route::middleware('auth')->group(function() {
    Route::controller(UserController::class)->prefix('/perfil')->middleware('check.userId')->group(function() {
        Route::get('/{user}', 'show')->name('users.show');
        Route::get('/{user}/edit', 'edit')->name('users.edit');
        Route::put('/{user}', 'update')->name('users.update');
        Route::delete('/{user}', 'destroy')->name('users.destroy');
    });

    Route::controller(ReservasController::class)->prefix('/reservas')->group(function() {
        Route::get('/', 'create')->name('reservas.create');
        Route::post('/', 'store')->name('reservas.store');
        Route::get('/{reserva}/edit', 'edit')->name('reservas.edit')->middleware('check.reservaId');
        Route::put('/{reserva}', 'update')->name('reservas.update')->middleware('check.reservaId');
        Route::delete('/{reserva}', 'destroy')->name('reservas.destroy')->middleware('check.reservaId');
    });
});


// ROTAS DO ADMINISTRADOR
Route::middleware('auth', 'check.role')->group(function() {
    Route::controller(AdminController::class)->group(function() {
        Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    });

    Route::controller(AdminReserva::class)->group(function() {
        Route::get('/admin/reservas', 'index')->name('admin.reservas.index');
        Route::get('/admin/reservas/{reserva}/edit', 'edit')->name('admin.reserva.edit');
        Route::put('/admin/reservas/{reserva}', 'update')->name('admin.reserva.update');
        Route::delete('/admin/reservas/{reserva}', 'destroy')->name('admin.reserva.destroy');
    });

    Route::controller(AdminUser::class)->group(function() {
        Route::get('/admin/users/{user}', 'show')->name('admin.user');
    });

    Route::controller(AdminCardapio::class)->group(function() {
        Route::get('/admin/cardapio/', 'index')->name('admin.cardapio.index');
        Route::get('/admin/cardapio/create', 'create')->name('admin.cardapio.create');
        Route::post('/admin/cardapio/', 'store')->name('admin.cardapio.store');
        Route::get('/admin/cardapio/{prato}/edit', 'edit')->name('admin.cardapio.edit');
        Route::put('/admin/cardapio/{prato}', 'update')->name('admin.cardapio.update');
        Route::delete('/admin/cardapio/{prato}', 'destroy')->name('admin.cardapio.destroy');
    });

});


