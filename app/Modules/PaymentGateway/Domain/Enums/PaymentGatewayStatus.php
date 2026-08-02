<?php

namespace App\Modules\PaymentGateway\Domain\Enums;

enum PaymentGatewayStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}