<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class CouponNotFoundException extends CouponClaimException
{
    public function __construct(string $message = "Coupon not found!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}