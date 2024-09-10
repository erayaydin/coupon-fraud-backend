<?php

namespace ErayAydin\CouponFraud\Actions;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;

class ResetUseCaseAction
{
    public function __invoke(): Response
    {
        Artisan::call('migrate:fresh --seed');

        return response()->make(status: 202);
    }
}