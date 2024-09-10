<?php

namespace ErayAydin\CouponFraud\Facades;

use ErayAydin\CouponFraud\Contracts\Fingerprint as FingerprintContract;
use ErayAydin\CouponFraud\Contracts\FingerprintEvent;
use Illuminate\Support\Facades\Facade;

/**
 * FingerprintJS
 *
 * @method static FingerprintEvent getEvent(string $requestId)
 */
class Fingerprint extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return FingerprintContract::class;
    }
}