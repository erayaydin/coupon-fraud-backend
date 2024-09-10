<?php

namespace ErayAydin\CouponFraud\Services\Fingerprint;

use DateTimeImmutable;
use ErayAydin\CouponFraud\Contracts\FingerprintEvent;
use ErayAydin\CouponFraud\Enums\BotDResult;
use ErayAydin\CouponFraud\Exceptions\BotDDataNotFoundException;
use ErayAydin\CouponFraud\Exceptions\ConfidenceNotFoundException;
use ErayAydin\CouponFraud\Exceptions\IdentificationDataNotFoundException;
use Fingerprint\ServerAPI\Model\BotdResult as FPBotdResult;
use Fingerprint\ServerAPI\Model\EventResponse;
use Fingerprint\ServerAPI\Model\ProductsResponseIdentificationData;

final readonly class Event implements FingerprintEvent
{
    public function __construct(
        private EventResponse $event
    ) { }

    public function hasIdentificationData(): bool
    {
        return $this->getIdentificationData() != null;
    }

    public function getIdentificationTime(): DateTimeImmutable
    {
        if (! $this->hasIdentificationData()) {
            throw new IdentificationDataNotFoundException();
        }

        return DateTimeImmutable::createFromMutable($this->getIdentificationData()->getTime());
    }

    public function getBotDResult(): BotDResult
    {
        $botDData = $this->getBotDData();

        if (! $botDData) {
            throw new BotDDataNotFoundException();
        }

        return BotDResult::tryFrom($botDData->getBot()->getResult());
    }

    public function getConfidenceScore(): float
    {
        if (! $this->hasIdentificationData()) {
            throw new IdentificationDataNotFoundException();
        }

        $confidence = $this->getIdentificationData()->getConfidence();

        if (! $confidence) {
            throw new ConfidenceNotFoundException();
        }

        return $confidence->getScore();
    }

    public function getVisitorId(): string
    {
        if (! $this->hasIdentificationData()) {
            throw new IdentificationDataNotFoundException();
        }

        return $this->getIdentificationData()->getVisitorId();
    }

    private function getIdentificationData(): ?ProductsResponseIdentificationData
    {
        return $this->event->getProducts()->getIdentification()?->getData();
    }

    private function getBotDData(): ?FPBotdResult
    {
        return $this->event->getProducts()->getBotd()?->getData();
    }
}