<?php

namespace ErayAydin\CouponFraud\Contracts;

use DateTimeImmutable;
use ErayAydin\CouponFraud\Enums\BotDResult;

interface FingerprintEvent
{
    public function hasIdentificationData(): bool;

    public function getIdentificationTime(): DateTimeImmutable;

    public function getBotDResult(): BotDResult;

    public function getConfidenceScore(): float;

    public function getVisitorId(): string;
}