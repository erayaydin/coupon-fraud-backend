<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class FingerprintRequestIdNotFoundException extends FingerprintRequestException
{
    public function __construct(string $message = "Fingerprint request ID not found!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}