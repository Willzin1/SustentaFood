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

// Rota para visualização do cardapio (User)
Route::controller(CardapioController::class)->group(function() {
    Route::get('/cardapio', 'index')->name('cardapio.index');
});

// Rotas para criação de um user
Route::controller(RegisterController::class)->prefix('/register')->middleware('guest')->group(function() {
    Route::get('/', 'create')->name('register.create');
    Route::post('/', 'store')->name('register.store');
});

// Rotas para a autenticação de um user
Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'create')->name('login')->middleware('guest');
    Route::post('/login', 'store')->name('login.store')->middleware('guest');
    Route::post('/logout', 'destroy')->name('login.destroy')->middleware('auth');
});

// Rotas para CRUD de reservas e CRUD de user. Somente users logados podem acessar.
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
        Route::get('/{reserva}/edit', 'edit')->name('reservas.edit');
        Route::put('/{reserva}', 'update')->name('reservas.update');
        Route::delete('/{reserva}', 'destroy')->name('reservas.destroy');
    });
});


// Rotas do administrador
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

// Rota de fallback para redirecionar caso a página não exista.
Route::fallback(function () {
    return response()->view('errors.page404', [], 404);
});
