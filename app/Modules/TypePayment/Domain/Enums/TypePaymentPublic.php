<?php

namespace App\Domain\TypePayment\Enums;

enum TypePaymentPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}