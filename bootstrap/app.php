<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'checkAdmin' => \App\Http\Middleware\CheckAdminMiddleware::class,
            'checkLogin' => \App\Http\Middleware\CheckLoginMiddleware::class,
            'checkNoLogin' => \App\Http\Middleware\CheckNoLoginMiddleware::class,
        ]);
        $middleware->group('admin', [
            'checkAdmin',
            'checkLogin',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
