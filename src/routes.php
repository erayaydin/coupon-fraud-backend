<?php

use ErayAydin\CouponFraud\Actions\CouponClaimAction;
use ErayAydin\CouponFraud\Actions\ResetUseCaseAction;
use Illuminate\Routing\Router;

/** @noinspection PhpUnhandledExceptionInspection */
/** @var Router $route */
$route = app()->make(Router::class);

$route->post('coupon', CouponClaimAction::class)
    ->middleware(['fingerprint']);

$route->delete('use-case', ResetUseCaseAction::class);
