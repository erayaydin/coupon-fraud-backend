<?php

namespace ErayAydin\CouponFraud\Middlewares;

use Closure;
use ErayAydin\CouponFraud\Contracts\Fingerprint;
use ErayAydin\CouponFraud\Enums\BotDResult;
use ErayAydin\CouponFraud\Exceptions\BadBotRequestException;
use ErayAydin\CouponFraud\Exceptions\FingerprintRequestIdNotFoundException;
use ErayAydin\CouponFraud\Exceptions\IdentificationDataNotFoundException;
use ErayAydin\CouponFraud\Exceptions\LowConfidenceScoreException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final readonly class FingerprintMiddleware
{
    public function __construct(
        private Fingerprint $fingerprint,
    ) { }

    public function __invoke(Request $request, Closure $next): Response|JsonResponse
    {
        if (! $request->has('requestId')) {
            throw new FingerprintRequestIdNotFoundException();
        }

        $event = $this->fingerprint->getEvent($request->input('requestId'));

        if (! $event->hasIdentificationData()) {
            throw new IdentificationDataNotFoundException();
        }

        if ($event->getBotDResult() === BotDResult::Bad) {
            throw new BadBotRequestException();
        }

        if ($event->getConfidenceScore() < 0.85) {
            throw new LowConfidenceScoreException();
        }

        $this->fingerprint->setVisitorId($event->getVisitorId());

        return $next($request);
    }
}