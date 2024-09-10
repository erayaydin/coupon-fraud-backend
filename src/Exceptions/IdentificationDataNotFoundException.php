<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class IdentificationDataNotFoundException extends FingerprintRequestException
{
    public function __construct(string $message = "Identification data not found!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}