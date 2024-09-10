<?php

namespace ErayAydin\CouponFraud\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function claims(): HasMany
    {
        return $this->hasMany(CouponClaim::class);
    }
}