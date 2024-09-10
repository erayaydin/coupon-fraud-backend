<?php

namespace ErayAydin\CouponFraud\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CouponClaim extends Model
{
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }
}