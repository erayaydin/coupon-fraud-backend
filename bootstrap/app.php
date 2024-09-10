<?php

use ErayAydin\CouponFraud\Exceptions\CouponClaimException;
use ErayAydin\CouponFraud\Exceptions\FingerprintRequestException;
use ErayAydin\CouponFraud\Providers\AppServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;

// Initialize laravel application...
$app = Application::configure(dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../src/routes.php'
    )
    ->withProviders([AppServiceProvider::class])
    ->withMiddleware()
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (FingerprintRequestException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 403);
        });

        $exceptions->render(function (CouponClaimException $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 403);
        });
    })
    ->create();

// Set application path to the src folder...
$app->useAppPath($app->basePath('src'));

return $app;