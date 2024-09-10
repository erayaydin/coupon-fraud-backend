<?php

namespace Database\Seeders;

use ErayAydin\CouponFraud\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Coupon::query()->create([
            'code' => 'PROMO1000',
        ]);
    }
}
