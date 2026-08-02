<?php

namespace App\Modules\PaymentGateway\Domain\Enums;

enum PaymentGatewayType : string
{
    case NIUBIZ = 'NIUBIZ';
    case CULQI = 'CULQI';
}