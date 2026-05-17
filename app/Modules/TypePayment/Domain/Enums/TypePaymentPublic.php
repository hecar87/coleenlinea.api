<?php

namespace App\Modules\TypePayment\Domain\Enums;

enum TypePaymentPublic : int
{
	case PRIVATE = 1;
	case PUBLIC = 2;
}