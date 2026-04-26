<?php

namespace App\Modules\TypeBank\Domain\Enums;

enum TypeBankStatus : int
{
	case DELETED = 0;
	case INACTIVE = 1;
	case ACTIVE = 2;
}