<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class BadBotRequestException extends FingerprintRequestException
{
    public function __construct(string $message = "Malicious bot detected!", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}