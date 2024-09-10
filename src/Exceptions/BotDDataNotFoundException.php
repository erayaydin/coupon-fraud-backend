<?php

namespace ErayAydin\CouponFraud\Exceptions;

use Throwable;

class BotDDataNotFoundException extends FingerprintRequestException
{
    public function __construct(string $message = "BotD data not found", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}