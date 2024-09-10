<?php

use Illuminate\Foundation\Application;

// Initialize laravel application...
$app = Application::configure(dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../src/routes.php'
    )
    ->withMiddleware()
    ->withExceptions()
    ->create();

// Set application path to the src folder...
$app->useAppPath($app->basePath('src'));

return $app;