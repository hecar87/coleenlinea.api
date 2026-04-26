<?php

namespace App\Domain\TypePayment\Enums;

enum TypePaymentStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}