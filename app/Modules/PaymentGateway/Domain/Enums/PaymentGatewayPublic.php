<?php

namespace App\Modules\PaymentGateway\Domain\Enums;

enum PaymentGatewayPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}