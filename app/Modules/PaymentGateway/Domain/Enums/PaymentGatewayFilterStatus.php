<?php

namespace App\Modules\PaymentGateway\Domain\Enums;

enum PaymentGatewayFilterStatus : string
{
    case ALL = 'ALL';
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}