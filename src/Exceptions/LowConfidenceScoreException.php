<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class LowConfidenceScoreException extends FingerprintRequestException
{
    public function __construct(string $message = "Identification confidence score too low!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}