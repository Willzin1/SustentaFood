<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkUser' => \App\Http\Middleware\CheckUser::class,
            'check.role' => \App\Http\Middleware\CheckRole::class,
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'checkApiToken' => \App\Http\Middleware\checkApiToken::class,
            'isGuest' => \App\Http\Middleware\guestCustom::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
