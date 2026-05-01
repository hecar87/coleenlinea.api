<?php

namespace App\Modules\TypeCurrency\Domain\Enums;

enum TypeCurrencyStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}