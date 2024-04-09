<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
       // $middleware->append(RoleMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->reportable(function (PostTooLargeException $e) {
            info('File To Long: ' . $e->getMessage());
        });

        $exceptions->reportable(function (NotFoundHttpException $e) {
            info('Not Found URL: ' . $e->getMessage());
        });
    })->create();
