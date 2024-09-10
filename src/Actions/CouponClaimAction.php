<?php

namespace ErayAydin\CouponFraud\Actions;

use ErayAydin\CouponFraud\Contracts\Fingerprint;
use ErayAydin\CouponFraud\Exceptions\CouponAlreadyUsedException;
use ErayAydin\CouponFraud\Exceptions\CouponNotFoundException;
use ErayAydin\CouponFraud\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final readonly class CouponClaimAction
{
    public function __construct(
        private Fingerprint $fingerprint
    ) { }

    public function __invoke(Request $request): JsonResponse
    {
        $coupon = Coupon::query()->where('code', $request->input('coupon'))->first();

        if (! $coupon) {
            throw new CouponNotFoundException();
        }

        $visitorId = $this->fingerprint->getVisitorId();

        if ($coupon->claims()->where('visitor_id', $visitorId)->exists()) {
            throw new CouponAlreadyUsedException();
        }

        $coupon->claims()->create([
            'visitor_id' => $visitorId,
        ]);

        return response()->json(['status' => true, 'message' => 'Coupon claimed!'], 201);
    }
}