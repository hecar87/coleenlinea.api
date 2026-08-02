<?php

namespace App\Modules\PaymentGateway\Domain\Enums;

enum PaymentGatewayFilterDisplay : string
{
    case ALL = 'ALL';
    case PUBLIC = 'PUBLIC';
    case PRIVATE = 'PRIVATE';
}