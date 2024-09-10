<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class CouponAlreadyUsedException extends CouponClaimException
{
    public function __construct(string $message = "This coupon already used!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}