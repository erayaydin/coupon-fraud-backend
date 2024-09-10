<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class ConfidenceNotFoundException extends FingerprintRequestException
{
    public function __construct(string $message = "Identification confidence not found!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}