<?php

use App\Http\Middleware\auth_admin;
use App\Http\Middleware\auth_user;
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
            'auth_admin' => auth_admin::class,
            'auth_user' => auth_user::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();