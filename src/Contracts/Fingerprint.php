<?php

namespace ErayAydin\CouponFraud\Contracts;

interface Fingerprint
{
    public function getEvent(string $requestId): FingerprintEvent;

    public function setVisitorId(string $visitorId): void;

    public function getVisitorId(): string;
}