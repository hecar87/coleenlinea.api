<?php

namespace App\Modules\TypePayment\Domain\Enums;

enum TypePaymentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}