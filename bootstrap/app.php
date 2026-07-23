<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware; // ✅ ADD THIS

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 🔹 Custom middleware alias
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
            'check-subscription' => \App\Http\Middleware\CheckCourseSubscription::class,
        ]);

    })
    ->withSchedule(function (Schedule $schedule) {

        $schedule->command('subscriptions:manage')->dailyAt('09:00');

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
