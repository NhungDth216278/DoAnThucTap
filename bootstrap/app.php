<?php

use App\Http\Middleware\CheckAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RedirectIfNotAdmin;
use App\Http\Middleware\CheckUserRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'adminLogin' => CheckAdmin::class,
            'hadLogin' => RedirectIfNotAdmin::class,
            'onlyUser' => CheckUserRole::class,
            'checkroleaccess' => \App\Http\Middleware\CheckRoleAccess::class,

            //'userLogin' => UserMiddleware::class,
            //'role' => RoleMiddleware::class,
           // 'shareDataCart' => ShareDataCart::class,
            //'prevent_admin' => PreventAdminAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
