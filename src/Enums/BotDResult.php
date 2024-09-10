<?php

namespace ErayAydin\CouponFraud\Enums;

enum BotDResult: string
{
    case NotDetected = 'notDetected';
    case Good = 'good';
    case Bad = 'bad';
}
