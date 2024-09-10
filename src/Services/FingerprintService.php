<?php

namespace ErayAydin\CouponFraud\Services;

use ErayAydin\CouponFraud\Contracts\Fingerprint;
use ErayAydin\CouponFraud\Contracts\FingerprintEvent;
use ErayAydin\CouponFraud\Services\Fingerprint\Event;
use Fingerprint\ServerAPI\Api\FingerprintApi;
use Fingerprint\ServerAPI\ApiException;
use Fingerprint\ServerAPI\Configuration;
use Fingerprint\ServerAPI\SerializationException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Arr;

final class FingerprintService implements Fingerprint
{
    private readonly FingerprintApi $fpClient;

    private string $visitorId;

    public function __construct(
        Client $client,
        Configuration $configuration,
    ) {
        $this->fpClient = new FingerprintApi($client, $configuration);
    }

    /**
     * @throws ApiException
     * @throws GuzzleException
     * @throws SerializationException
     */
    public function getEvent(string $requestId): FingerprintEvent
    {
        $model = Arr::first($this->fpClient->getEvent($requestId));

        return new Event($model);
    }

    public function setVisitorId(string $visitorId): void
    {
        $this->visitorId = $visitorId;
    }

    public function getVisitorId(): string
    {
        return $this->visitorId;
    }
}